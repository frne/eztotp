<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.2
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

$Module = array( 'name' => 'eztotpadmin' );

$ViewList = array(
    'edituser' => array(
                    'script'                  => 'edituser.php',
                    'params'                  => array("user_id", "action")
                ),
    'enableuser' => array(
                        'script'                  => 'enableuser.php',
                        'params'                  => array("user_id")
                    )
);

$FunctionList = array();
