<?php
/**
 * TITLE
 *
 * @access public
 * @author ymc-frne <frank.neff@ymc.ch>
 * @license ymc standard license <license@ymc.ch>
 * @since 2012/03/21
 */

/**
 * Class EzTotpConfiguration
 */
class EzTotpConfiguration
{

    const MODE_DEVELOPMENT = 0;
    const MODE_PRODUCTION = 1;

    /**
     * @var int
     */
    private $mode;

    /**
     * @param string $mode
     */
    public function __construct( $mode )
    {
        switch ( $mode )
        {
            case "development":
                $this->mode = self::MODE_DEVELOPMENT;
                break;

            case "production":
                $this->mode = self::MODE_PRODUCTION;
                break;

            default:
                throw new EzTotpConfigurationException("No valid configuration mode!");
                break;
        }
    }
}
