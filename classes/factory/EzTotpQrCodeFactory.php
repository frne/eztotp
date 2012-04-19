<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.3
 * @author Frank Neff <frankneff.ch>
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
    protected function init()
    {
    }

    /**
     * @param EzTotpUser $user
     */
    public function setUser(EzTotpUser $user)
    {
        $this->user = $user;
    }

    /**
     * @param EzTotpAuthentication $auth
     */
    public function setAuth(EzTotpAuthentication $auth)
    {
        $this->auth = $auth;
    }

    private function provideQrCodeString()
    {
        if (!$this->user instanceof EzTotpUser) {
            throw new EzTotpFactoryException("Y U no provide an EzTotpUser?");
        }

        $username = $this->user->Login;
        $serviceName = urlencode(eZINI::instance()->BlockValues["SiteSettings"]["SiteName"]);
        $seed = $this->user->otpSeed;

        $format = 'otpauth://totp/%s@%s?secret=%s';
        return sprintf($format, $username, $serviceName, $seed);
    }

    public function getQrCode()
    {
        $qrCodeString = $this->provideQrCodeString();
        QRcode::png($qrCodeString, false, 3, 6, 2);
    }


}
