<?php
/**
 * Created by JetBrains PhpStorm.
 * User: frank
 * Date: 31.03.12
 * Time: 08:04
 * To change this template use File | Settings | File Templates.
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