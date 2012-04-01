<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.1 unstable/development
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

class EzTotpUserOperator
{
    function __construct()
    {
    }

    function operatorList()
    {
        return array('eztotp_user_state', 'eztotp_user_groups');
    }

    function namedParameterPerOperator()
    {
        return true;
    }

    function namedParameterList()
    {
        return array('state_is' => array('param1' => array('type' => 'string',
                'required' => false,
                'default' => "")),
            'eztotp_user_state' => array(),
            'is_foreign' => array('context_portal' => array('type' => 'object',
                'required' => false,
                'default' => null)));
    }

    function modify($tpl, $operatorName, $operatorParameters, $rootNamespace, $currentNamespace, &$operatorValue, $namedParameters)
    {

        switch ($operatorName)
        {
            case 'eztotp_user_state':
                {
                $operatorValue = $this->getUserState($operatorValue);
                }
                break;

            default:
                {
                $operatorValue = '';
                }
                break;
        }
    }

    private function getUserState($operatorValue)
    {
        switch ((int)$operatorValue)
        {
            case EzTotpConfiguration::USER_STATE_OTP:
                return '<span class="label label-success">active</span>';
                break;

            case EzTotpConfiguration::USER_STATE_NOOTP:
                return '<span class="label label-warning">inactive</span>';
                break;

            case EzTotpConfiguration::USER_STATE_BLOCKED:
                return '<span class="label label-important">blocked</span>';
                break;

            default:
                return '<span class="label label-success">no state</span>';
                break;
        }
    }
}