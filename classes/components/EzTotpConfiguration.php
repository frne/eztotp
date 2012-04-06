<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.1 unstable/development
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

/**
 * Class EzTotpConfiguration
 */
class EzTotpConfiguration extends EzTotpPropertyOverloadAbstract
{
    /**
     * Constants for the different user-states
     */
    const USER_STATE_NOOTP = 0;
    const USER_STATE_OTP = 1;
    const USER_STATE_BLOCKED = 2;

    /**
     * Loads configuration from INI-File
     */
    public function loadConfiguration(eZINI $iniInstance)
    {

        foreach($iniInstance->BlockValues as $key => $value)
        {
            $this->$key = $value;
        }
    }
}
