<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.1 unstable/development
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

$Module = array( 'name' => 'eztotpadmin' );

$ViewList = array(
    'dashboard' => array(
        'default_navigation_part' => 'eztotpadminnavigationpart',
        'script'                  => 'dashboard.php',
        'params'                  => array()
    )
);

$FunctionList = array();
