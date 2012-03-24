<?php
/**
 * Configuration Exception for ezTotp
 *
 * @access public
 * @author ymc-frne <frank.neff@ymc.ch>
 * @license ymc standard license <license@ymc.ch>
 * @since 2012/03/21
 */

/**
 * Class EzTotpConfigurationException
 */
class EzTotpConfigurationException extends Exception implements EzTotpExceptionInterface
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
        return "An configuration error has occured. This has been reported to the system administrator...\n" .
            __CLASS__ .
            ":[{$this->code}]:{$this->message}\n\n\n";
    }
}
