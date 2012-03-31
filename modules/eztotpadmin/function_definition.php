<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.1 unstable/development
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

$FunctionList = array();

$FunctionList['user_list'] = array( 'name' => 'user_list',
                                 'operation_types' => 'read',
                                 'call_method' => array( 'class' => 'EzTotpAdminFunctionCollection',
                                                         'method' => 'fetchUserList' ),
                                 'parameter_type' => 'standard',
                                 'parameters' => array( array( 'name' => 'type',
                                                               'type' => 'string',
                                                               'required' => false,
                                                               'default' => '' )
                                 ) );


