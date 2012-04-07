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
 * Class EzTotpConfigurationException
 */
class EzTotpLogException extends Exception implements EzTotpExceptionInterface
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
        return "An factory error has occured in log ". $this->getFile() . ". This has been reported to the system administrator...\n" .
            __CLASS__ .
            ":[{$this->code}]:{$this->message}\n\n\n";
    }
}
