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
$Result              = array();
$Result['content']   = $Tpl->fetch( 'design:eztotp/backend/dashboard.tpl' );
$Result['left_menu'] = 'design:eztotp/backend/left_menu.tpl';
$Result['path']      = array(
                           array( 'url' => false, 'text' => ezpI18n::tr( 'eztotpadmin/dashboard', 'eztotpadmin' ) )
                       );