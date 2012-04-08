<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.2
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

$ini = eZINI::instance("eztotp.ini");

$config = new EzTotpConfiguration();
$config->loadConfiguration($ini);

$log = new EzTotpLog($config);
$logList = $log->getListByType($Params["type"], (int) $Params["limit"], (int) $Params["offset"]);

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode($logList);