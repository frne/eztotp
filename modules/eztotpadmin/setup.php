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
$Result              = array();
$Result['content']   = $Tpl->fetch( 'design:backend/setup.tpl' );
$Result['left_menu'] = 'design:backend/left_menu.tpl';
$Result['path']      = array(
                           array( 'url' => false, 'text' => ezpI18n::tr( 'eztotpadmin/setup', 'eztotpadmin' ) )
                       );