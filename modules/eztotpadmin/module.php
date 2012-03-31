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
    ),
    'setup' => array(
            'default_navigation_part' => 'eztotpadminnavigationpart',
            'script'                  => 'setup.php',
            'params'                  => array()
        ),
    'users' => array(
                'default_navigation_part' => 'eztotpadminnavigationpart',
                'script'                  => 'users.php',
                'params'                  => array("type")
            ),
    'edituser' => array(
                    'script'                  => 'edituser.php',
                    'params'                  => array("user_id", "action")
                )
);

$FunctionList = array();
