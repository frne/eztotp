<?php
/**
 * EzTotp: Two-way authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.1 unstable/development
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

class EzTotpAuthenticationFactory extends EzTotpFactoryAbstract
{

    /**
     * @var EzTotpUserFactory
     */
    private $user;

    /**
     * @var EzTotpAuthentication
     */
    private $authentication;

    protected function init()
    {
    }

    /**
     * @param EzTotpUserFactory $user
     */
    public function setUser(EzTotpUser $user)
    {
        $this->user = $user;
    }

    /**
     * @param EzTotpAuthentication $authentication
     */
    public function setAuthentication(EzTotpAuthentication $authentication )
    {
        $this->authentication = $authentication;
    }



}
