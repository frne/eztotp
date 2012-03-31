<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.1 unstable/development
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

try{

$Tpl                 = eZTemplate::factory();
$Result              = array();

$config = new EzTotpConfiguration();
$config->loadConfiguration();
$factory = new EzTotpFactory($config);
$userFactory = $factory->load("user");

$userId = $Params["user_id"];
$user = $userFactory->getUserById($userId);

if($user instanceof EzTotpUser)
{
    throw new EzTotpUserException("No valid user id!");
}

}
catch(Exception $e)
{
    var_dump($e);
}

//TODO user edit functions

switch($Params["action"])
{

}