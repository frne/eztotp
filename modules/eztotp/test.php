<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.1 unstable/development
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */


echo "<pre>";

try {
    // get ini
    $ini = eZINI::instance("eztotp.ini");

    // create configuration
    $configuration = new EzTotpConfiguration();
    $configuration->loadConfiguration($ini);


    // create factory
    $log = new EzTotpLog($configuration);
    $log->write(EzTotpConfiguration::LOG_TYPE_HILEVEL, EzTotpConfiguration::LOG_LEVEL_INFO, "Test log");

    echo "</pre>";

}
catch (Exception $e)
{
    print_r($e);
}
eZExecution::cleanExit();
