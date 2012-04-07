<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.2
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
     * Constants for the different log-types
     */
    const LOG_TYPE_HILEVEL = 0;
    const LOG_TYPE_ERROR = 1;
    const LOG_TYPE_ACCESS = 2;

    /**
     * Constants for the different log-levels
     */
    const LOG_LEVEL_INFO = 0;
    const LOG_LEVEL_WARN = 1;
    const LOG_LEVEL_EXCEPTION = 2;

    /**
     * @param eZINI $iniInstance
     */
    public function loadConfiguration(eZINI $iniInstance)
    {

        foreach ($iniInstance->BlockValues as $key => $value)
        {
            $this->$key = $value;
        }
    }

    /**
     * @return array
     */
    public function getConstants()
    {
        $reflect = new ReflectionClass(get_class($this));
        return $reflect->getConstants();
    }
}
