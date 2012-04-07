<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.2
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

$Tpl                 = eZTemplate::factory();
$Tpl->setVariable("userType", $Params["type"]);
$Result              = array();
$Result['left_menu'] = 'design:eztotp/backend/left_menu.tpl';
$Result['path']      = array(
                           array( 'url' => false, 'text' => ezpI18n::tr( 'eztotpadmin/users', 'eztotpadmin' ) )
                       );
$Result['content']   = $Tpl->fetch( 'design:eztotp/backend/users.tpl' );