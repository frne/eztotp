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

if(empty($Params["type"]))
{
    header("Location: :/log/error");
}

$typeConstantName = "LOG_TYPE_" . strtoupper($Params["type"]); //error -> EzTotpCOnfiguration::LOG_TYPE_ERROR
$configReflection = new ReflectionClass ('EzTotpConfiguration');
$configConstants = $configReflection->getConstants();
if(array_key_exists($typeConstantName, $configConstants))
{
    $Tpl                 = eZTemplate::factory();
    $Tpl->setVariable("pageTitle", "Logs / " . ucfirst($Params["type"]));
    $Tpl->setVariable("logType", $Params["type"]);

    $Result              = array();
    $Result['left_menu'] = 'design:eztotp/backend/left_menu.tpl';
    $Result['path']      = array(
                               array(
                                   'url' => false,
                                   'text' => ezpI18n::tr(
                                       'eztotpadmin/log/' . $Params["type"],
                                       'TOTP Admin - Log / ' . ucfirst($Params["type"])
                                    )));
    $Result['content']   = $Tpl->fetch( 'design:eztotp/backend/log.tpl');
}
else
{
    header("Location: ./log/error");
}




