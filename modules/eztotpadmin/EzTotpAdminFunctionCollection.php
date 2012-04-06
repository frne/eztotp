<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.1 unstable/development
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */
class EzTotpAdminFunctionCollection
{
    public static function fetchUserList($type)
    {
        $userFactory = self::getUserFactory();

        switch ($type)
        {
            case "active":
                $state = EzTotpConfiguration::USER_STATE_OTP;
                break;

            case "blocked":
                $state = EzTotpConfiguration::USER_STATE_BLOCKED;
                break;

            case "inactive":
                $state = EzTotpConfiguration::USER_STATE_NOOTP;
                break;

            default:
                $state = false;
                break;
        }
        $list = array();

        if($state !== false)
        {
            $userObjectlist = $userFactory->fetchUserListByState($state);
        }
        else
        {
            $userObjectlist = $userFactory->fetchUserList();
        }
        foreach ($userObjectlist as $key => $user)
        {
            $list[] = self::mapEztotpUserObjectToArray($user);
        }

        return array("result" => $list);
    }

    private static function getUserFactory()
    {
        $factory = self::getFactory();
        return $factory->load("user");
    }

    private static function getFactory()
    {
        // get ini
        $ini = eZINI::instance("eztotp.ini");

        // load configuration
        $config = new EzTotpConfiguration();
        $config->loadConfiguration($ini);

        // create factory
        return new EzTotpFactory($config);
    }

    private static function mapEztotpUserObjectToArray(EzTotpUser $user)
    {
        return array(
            "id" => $user->id(),
            "login" => $user->Login,
            "mail" => $user->Email,
            "groups" => $user->Groups,
            "otpSeed" => $user->otpSeed,
            "otpState" => $user->otpState
        );
    }
}
