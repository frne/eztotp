<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.2
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

$userId = (int)$Params["userId"];

 // get ini
$ini = eZINI::instance("eztotp.ini");

// load configuration
$config = new EzTotpConfiguration();
$config->loadConfiguration($ini);

// create factory
$factory = new EzTotpFactory($config);

// create user
$userFactory = $factory->load("user");
$user = $userFactory->getUserById($userId);
if($user instanceof EzTotpUser)
{
   // create qr
   $qrFactory = $factory->load("qrcode");
   $qrFactory->setUser($user);
   $qrFactory->getQrCode();
}

eZExecution::cleanExit();