<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
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
    public function setAuthentication(EzTotpAuthentication $authentication)
    {
        $this->authentication = $authentication;
    }

    public function authenticate($pass)
    {
        if (!$this->user instanceof EzTotpUser) {
            $message = "No valid user given to " . __CLASS__ .
                "! Please provide a EzTotpUser object to autenticate using setUser()";
            throw new EzTotpFactoryException($message);
        }

        if (!$this->authentication instanceof EzTotpAuthentication) {
            $message = "No valid authentication given to " . __CLASS__ .
                "! Please provide a EzTotpAuthentication object to autenticate using setAuthentication()";
            throw new EzTotpFactoryException($message);
        }

        // switch user state
        switch ((int)$this->user->otpState)
        {
            case EzTotpConfiguration::USER_STATE_NOOTP:
                return $this->logIn($this->user, $pass["userPassword"]);
                break;

            case EzTotpConfiguration::USER_STATE_BLOCKED:
                return false;
                break;

            case EzTotpConfiguration::USER_STATE_OTP:
                // TOTP authentication
                $this->authentication->setInitialisationSeed($this->user->otpSeed);

                var_dump(array(
                    "manualKey" => $pass["otpKey"],
                    "generatedKey" => $this->authentication->getKey()
                ));

                if ($this->authentication->verify($pass["otpKey"])) {
                    return $this->logIn($this->user, $pass["userPassword"]);
                }

                // TODO: Logging

                return false;
                break;

            default:
                throw new EzTotpAuthenticationException("No valid user state: " . (int)$this->user->otpState);
                break;
        }


    }

    private function logIn(EzTotpUser $user, $password)
    {
        return eZUser::loginUser($user->Login, $password);
    }


}
