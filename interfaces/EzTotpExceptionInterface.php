<?php
/**
 * Interface for EzTotp Exceptions
 *
 * @access public
 * @author ymc-frne <frank.neff@ymc.ch>
 * @license ymc standard license <license@ymc.ch>
 * @since 2012/03/21
 */

/**
 * Interface EzTotpException
 */
interface EzTotpExceptionInterface
{
    /**
     * Constructor
     *
     * @abstract
     * @param string $message
     * @param int $code
     * @return EzTotpException
     */
    public function __construct( $message, $code = 0 );

    /**
     * Function to provide the error-string
     *
     * @abstract
     * @return string Error string
     */
    public function __toString();
}
