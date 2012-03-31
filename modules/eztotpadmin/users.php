<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.1 unstable/development
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

$Tpl                 = eZTemplate::factory();
$Result              = array();
$Result['left_menu'] = 'design:eztotp/backend/left_menu.tpl';
$Result['path']      = array(
                           array( 'url' => false, 'text' => ezpI18n::tr( 'eztotpadmin/users', 'eztotpadmin' ) )
                       );

switch($Params["type"])
{
    case "blocked":
            $Result['content']   = $Tpl->fetch( 'design:eztotp/backend/usersBlocked.tpl' );
            break;
    case "active":
    default:
        $Result['content']   = $Tpl->fetch( 'design:eztotp/backend/usersActive.tpl' );
        break;
}