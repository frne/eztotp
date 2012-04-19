<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.3
 * @author Frank Neff <frankneff.ch>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

class EzTotpLogError implements EzTotpLogInterface
{
    public function write($type, $level, $message, $userId = null)
    {

        $logObject = EzTotpLogPersistentObject::create(
            EzTotpConfiguration::LOG_TYPE_ERROR,
            $level,
            $message,
            $userId
        );
        $logObject->store();
    }
}
