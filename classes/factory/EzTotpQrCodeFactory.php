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
 * Class EzTotpQrCode
 */
class EzTotpQrCodeFactory extends EzTotpFactoryAbstract
{

    /**
     * @var EzTotpUser
     */
    private $user;

    /**
     * @var EzTotpAuthentication
     */
    private $auth;

    /**
     * Nothing to init
     */
    private function init()
    {
    }

    /**
     * @param EzTotpUser $user
     */
    public function setUser( EzTotpUser $user )
    {
        $this->user = $user;
    }

    /**
     * @param EzTotpAuthentication $auth
     */
    public function setAuth( EzTotpAuthentication $auth )
    {
        $this->auth = $auth;
    }



}
