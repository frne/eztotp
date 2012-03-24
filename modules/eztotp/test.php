<?php
/**
 * EzTotp: Two-way authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.1 unstable/development
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */


echo "<pre>";
// wire up for eZTotop

try {
    // create configuration
    $configuration = new EzTotpConfiguration();
    $configuration->loadConfiguration();



    // create factory
    $factory = new EzTotpFactory($configuration);
    $userFactory = $factory->load("user");

    // get user
    $user = $userFactory->getUserById(14);

    print_r($user);

    echo "</pre>";

}
catch (Exception $e)
{
    print_r($e);
}
eZExecution::cleanExit();
