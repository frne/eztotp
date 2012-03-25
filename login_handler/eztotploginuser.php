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
    static function loginUser($login, $pass, $authenticationMatch = false)
    {
        // create configuration
        $configuration = new EzTotpConfiguration();
        $configuration->loadConfiguration();

        // create user
        $factory = new EzTotpFactory($configuration);
        $userFactory = $factory->load("user");
        $user = $userFactory->fetchByName($login);

        $auth = $factory->load("auth");
        $authenticationObject = new EzTotpAuthentication($configuration);

        $auth->setAuthentication($authenticationObject);
        $auth->setUser($user);
        $authResult = $auth->authenticate($pass);

        echo "<h3>";
        var_dump($authResult);
        echo "</h3>";

        return $authResult;
    }
}
