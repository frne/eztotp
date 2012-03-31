<?php
/**
 * Created by JetBrains PhpStorm.
 * User: frank
 * Date: 31.03.12
 * Time: 10:46
 * To change this template use File | Settings | File Templates.
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
                throw new EzTotpUserException("Provide type 'active', 'blocked' or 'inactive'!");
                break;
        }



        $list = array();
        $userObjectlist = $userFactory->fetchUserListByState($state);
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
        // load configuration
        $config = new EzTotpConfiguration();
        $config->loadConfiguration();

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
