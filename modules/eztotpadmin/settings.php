<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.3
 * @author Frank Neff <frankneff.ch>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

$Tpl                 = eZTemplate::factory();
$Tpl->setVariable("pageTitle", "Settings ");

$Result              = array();
$Result['content']   = $Tpl->fetch( 'design:eztotp/backend/settings.tpl');
$Result['left_menu'] = 'design:eztotp/backend/left_menu.tpl';
$Result['path']      = array(
                           array(
                               'url' => false,
                               'text' => ezpI18n::tr(
                                   'eztotpadmin/log/',
                                   'TOTP Admin - Log')
                                ));