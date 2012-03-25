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
 * Class EzTotpUserException
 */
class EzTotpException extends Exception implements EzTotpExceptionInterface
{
    /**
     * @param string $message
     * @param int $code
     */
    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "An error has occured. The error was automatically reported...\n" . __CLASS__ . ": [{$this->code}]:
        {$this->message}\n\n\n";
    }
}
