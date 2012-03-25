<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.1 unstable/development
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

class EzTotpLoginUser extends eZUser
{
    static function loginUser($login, $password, $authenticationMatch = false)
    {
        // ugly as hell, but eZPublish wants me to do that

        // create configuration
        $configuration = new EzTotpConfiguration();
        $configuration->loadConfiguration();

        // create user
        $factory = new EzTotpFactory($configuration);
        $userFactory = $factory->load("user");
        $user = $userFactory->fetchByName($login);

        $auth = $factory->load("auth");
        $authenticationObject = new EzTotpAuthentication();

        $auth->setAuthentication($authenticationObject);
        $auth->setUser($user);

        var_dump($auth);


        return false;

    }
}
