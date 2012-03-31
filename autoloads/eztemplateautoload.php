<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.1 unstable/development
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

$eZTemplateOperatorArray = array();
$eZTemplateOperatorArray[] = array( 'script' => '',
                                    'class' => 'EzTotpUserOperator',
                                    'operator_names' => array( 'eztotp_user_state', 'eztotp_user_group' ) );