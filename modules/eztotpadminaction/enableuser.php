<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.1 unstable/development
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

$result = array();

try {
    $config = new EzTotpConfiguration();
    $config->loadConfiguration();
    $factory = new EzTotpFactory($config);
    $userFactory = $factory->load("user");

    $userId = $Params["user_id"];
    $user = $userFactory->getUserById($userId);

    if (!$user instanceof EzTotpUser) {
        throw new EzTotpUserException("No valid user id!");
    }

    $result["userid"] = $user->id();

    if ($user->otpObject instanceof EzTotpUserPersistentObject) {
        if (!empty($user->otpState) and $user->otpState == EzTotpConfiguration::USER_STATE_OTP) {
            $result["action"] = "none";
        }
        else
        {
            var_dump($user->otpObject->attribute("state"));
            var_dump($user->otpObject->State);
            $user->otpObject->setAttribute("state", "1");
            $user->otpObject->store();
            $result["action"] = "enabled";
        }
    }
    else
    {
        $authentication = new EzTotpAuthentication($config);
        $initialSeed = $authentication->generate_secret_key();
        $user = EzTotpUserPersistentObject::create(
            $user->id(),
            EzTotpConfiguration::USER_STATE_OTP,
            $initialSeed
        );
        $user->store();

        $result["action"] = "created";
        $result["seed"] = $initialSeed;
    }
}
catch (Exception $e)
{
    $result["error"] = true;
    if ($e instanceof EzTotpUserException) {
        $result["errormsg"] = "User does not exist or database error!";
    }
    else
    {
        $result["errormsg"] = "A fatal error ocured while enabling user!";
    }
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
//header('Content-type: application/json');

echo json_encode($result);

eZExecution::cleanExit();