<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.2
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

class EzTotpLoginUser extends eZUser
{
    static function loginUser($login, $pass, $authenticationMatch = false)
    {
        // get ini
        $ini = eZINI::instance("eztotp.ini");

        // create configuration
        $configuration = new EzTotpConfiguration();
        $configuration->loadConfiguration($ini);

        // create user
        $factory = new EzTotpFactory($configuration);
        $userFactory = $factory->load("user");
        $user = $userFactory->fetchByName($login);

        if (!$user instanceof EzTotpUser) {
            $factory->log->write(
                EzTotpConfiguration::LOG_TYPE_ACCESS,
                EzTotpConfiguration::LOG_LEVEL_WARN,
                "User does not exist: '$login'"
            );
            return false;
        }

        // load authentication
        $auth = $factory->load("auth");
        $authenticationObject = new EzTotpAuthentication($configuration);

        // authenticate user
        $auth->setAuthentication($authenticationObject);
        $auth->setUser($user);
        $authResult = $auth->authenticate($pass);

        // return the logged-in user or false
        return $authResult;
    }
}
