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
    public function loadConfiguration()
    {
        $iniInstance = eZINI::instance("eztotp.ini");

        foreach($iniInstance->BlockValues as $key => $value)
        {
            $this->$key = $value;
        }
    }
}
