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
