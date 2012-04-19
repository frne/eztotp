<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.3
 * @author Frank Neff <frankneff.ch>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

$ini = eZINI::instance("eztotp.ini");

$config = new EzTotpConfiguration();
$config->loadConfiguration($ini);


$typeConstantName = "LOG_TYPE_" . strtoupper($Params["type"]); //error -> EzTotpCOnfiguration::LOG_TYPE_ERROR
$configReflection = new ReflectionClass ('EzTotpConfiguration');
$configConstants = $configReflection->getConstants();
if(array_key_exists($typeConstantName, $configConstants))
{
    $log = new EzTotpLog($config);
    $logList = $log->getListByType($configConstants[$typeConstantName], (int) $Params["limit"], (int) $Params["offset"]);
}
else
{
    $logList = array("error", true);
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode($logList);
eZExecution::cleanExit();