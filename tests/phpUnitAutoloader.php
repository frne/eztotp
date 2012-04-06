<?php

define( "EZ_PUBLISH_BASE_PATH", __DIR__ . '/../../../' );

set_include_path(
    EZ_PUBLISH_BASE_PATH . PATH_SEPARATOR .
    '.' . PATH_SEPARATOR .
    EZ_PUBLISH_BASE_PATH . '/lib/ezc' . PATH_SEPARATOR .
    get_include_path()
);

if ( file_exists( EZ_PUBLISH_BASE_PATH . 'config.php' ) )
{
    require EZ_PUBLISH_BASE_PATH . 'config.php';
}

$useBundledComponents = defined( 'EZP_USE_BUNDLED_COMPONENTS' ) ? EZP_USE_BUNDLED_COMPONENTS === true : file_exists( 'lib/ezc' );
if ( $useBundledComponents )
{
    require 'Base/src/base.php';
    $baseEnabled = true;
}
else
{
    if ( defined( 'EZC_BASE_PATH' ) )
    {
        require EZC_BASE_PATH;
        $baseEnabled = true;
    }
    else
    {
        $baseEnabled = @include 'ezc/Base/base.php';
        if ( !$baseEnabled )
        {
            $baseEnabled = @include 'Base/src/base.php';
        }
    }
}

/**
 * Provides the native autoload functionality for eZ Publish
 *
 * @package kernel
 */
class phpUnitAutoloader
{
    protected static $ezpClasses = null;

    public static function autoload( $className )
    {
        if ( self::$ezpClasses === null )
        {
            $ezpKernelClasses = require 'autoload/ezp_kernel.php';
            $ezpExtensionClasses = false;
            $ezpTestClasses = false;

            if ( file_exists( EZ_PUBLISH_BASE_PATH . 'var/autoload/ezp_extension.php' ) )
            {
                $ezpExtensionClasses = require 'var/autoload/ezp_extension.php';
            }

            if ( file_exists( EZ_PUBLISH_BASE_PATH . 'var/autoload/ezp_tests.php' ) )
            {
                $ezpTestClasses = require 'var/autoload/ezp_tests.php';
            }

            if ( $ezpExtensionClasses and $ezpTestClasses )
            {
                self::$ezpClasses = $ezpTestClasses + $ezpExtensionClasses + $ezpKernelClasses;
            }
            else {
                if ( $ezpExtensionClasses )
                {
                    self::$ezpClasses = $ezpExtensionClasses + $ezpKernelClasses;
                }
                else
                {
                    if ( $ezpTestClasses )
                    {
                        self::$ezpClasses = $ezpTestClasses + $ezpKernelClasses;
                    }
                    else
                    {
                        self::$ezpClasses = $ezpKernelClasses;
                    }
                }
            }

            if ( defined( 'EZP_AUTOLOAD_ALLOW_KERNEL_OVERRIDE' ) and EZP_AUTOLOAD_ALLOW_KERNEL_OVERRIDE )
            {
                // won't work, as eZDebug isn't initialized yet at that time
                // eZDebug::writeError( "Kernel override is enabled, but var/autoload/ezp_override.php has not been generated\nUse bin/php/ezpgenerateautoloads.php -o", 'autoload.php' );
                if ( $ezpKernelOverrideClasses = include 'var/autoload/ezp_override.php' )
                {
                    self::$ezpClasses = array_merge( self::$ezpClasses, $ezpKernelOverrideClasses );
                }
            }
        }

        if ( isset( self::$ezpClasses[$className] ) )
        {
            require( self::$ezpClasses[$className] );
        }
    }

    /**
     * Resets the local, in-memory autoload cache.
     *
     * If the autoload arrays are extended during a requests lifetime, this
     * method must be called, to make them available.
     *
     * @return void
     */
    public static function reset()
    {
        self::$ezpClasses = null;
    }

    public static function updateExtensionAutoloadArray()
    {
        $autoloadGenerator = new eZAutoloadGenerator();
        try
        {
            $autoloadGenerator->buildAutoloadArrays();

            self::reset();
        }
        catch ( Exception $e )
        {
            echo $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine();
        }
    }
}

spl_autoload_register( array( 'phpUnitAutoloader', 'autoload' ) );
spl_autoload_register( array( 'ezcBase', 'autoload' ) );
