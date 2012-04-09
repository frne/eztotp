<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.2
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

    /**
     * @param array $pass
     * @return EzUser|boolean
     * @throws EzTotpAuthenticationException|EzTotpFactoryException
     */
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

        if (!isset($this->user->otpState)) {
            $this->user->otpState = EzTotpConfiguration::USER_STATE_NOOTP;
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

                if ($this->authentication->verify($pass["otpKey"])) {
                    return $this->logIn($this->user, $pass["userPassword"]);
                }

                $this->_factory->log->write(
                    EzTotpConfiguration::LOG_TYPE_ACCESS,
                    EzTotpConfiguration::LOG_LEVEL_WARN,
                    "Authentication failed: Wrong TOTP key!",
                    $this->user->id()
                );

                return false;
                break;

            default:
                throw new EzTotpAuthenticationException("No valid user state: " . (int)$this->user->otpState);
                break;
        }


    }

    /**
     * @param EzTotpUser $user
     * @param string $password
     * @return eZUser|boolean
     */
    private function logIn(EzTotpUser $user, $password)
    {
        $ezUser = eZUser::loginUser($user->Login, $password);

        if ($ezUser instanceof eZUser) {
            $this->_factory->log->write(
                EzTotpConfiguration::LOG_TYPE_ACCESS,
                EzTotpConfiguration::LOG_LEVEL_INFO,
                "Successfully authenticated",
                $user->id()
            );
        }
        else
        {
            $this->_factory->log->write(
                EzTotpConfiguration::LOG_TYPE_ACCESS,
                EzTotpConfiguration::LOG_LEVEL_WARN,
                "Authentication failed: Wrong password!",
                $user->id()
            );
        }

        return $ezUser;
    }


}
