<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.2
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

class EzTotpUserOperator
{
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
        return array();
    }

    function modify($tpl, $operatorName, $operatorParameters, $rootNamespace, $currentNamespace, &$operatorValue, $namedParameters)
    {

        switch ($operatorName)
        {
            case 'eztotp_user_state':
                $operatorValue = $this->getUserState($operatorValue);
                break;

            default:
                throw new RuntimeException("No valid operator name!");
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
                return '<span class="label label-warning">no state</span>';
                break;
        }
    }
}