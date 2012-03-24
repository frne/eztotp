<?php
/**
 * Main Exception for ezTotp
 *
 * @access public
 * @author ymc-frne <frank.neff@ymc.ch>
 * @license ymc standard license <license@ymc.ch>
 * @since 2012/03/21
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
