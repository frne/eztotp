<?php
/**
 * Created by JetBrains PhpStorm.
 * User: frank
 * Date: 25.03.12
 * Time: 10:31
 * To change this template use File | Settings | File Templates.
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

    public function legacy()
    {
        $ini = eZINI::instance('qhyubikey.ini');
                $debugOutput = $ini->variable('QHYubiKeySettings', 'DebugOutput');
                $YubiKey = $password;
                if ($debugOutput) eZLog::write("Login handler, YubiKey: {$YubiKey}");

                $user = eZUser::fetchByName($login);
                $userContentObject = eZContentObject :: fetch($user->attribute('contentobject_id'));
                $userDatamap = $userContentObject->dataMap();

                if (isset($userDatamap['yubikeys'])) {
                    $matrix = new eZMatrix('');
                    $matrix->decodeXML($userDatamap['yubikeys']->attribute('data_text'));
                    $userRecordedYubiKeyOTPArray = $matrix->Matrix['columns']['sequential'][1]['rows'];
                }

                $userUseOTP4MultiFactor = $userDatamap['multifactor']->attribute('data_int');

                $YubiKeyPrefix = substr($YubiKey, 0, 12);

                $recordedMatchedPrefixes = array();
                foreach ($userRecordedYubiKeyOTPArray as $key => $userRecordedYubiKeyOTP) {
                    if ($debugOutput) eZLog::write("Yubikey{$key}: {$userRecordedYubiKeyOTP}");
                    $recordedYubiKeyPrefix = substr($userRecordedYubiKeyOTP, 0, 12);
                    if ($YubiKeyPrefix == $recordedYubiKeyPrefix) {
                        if ($debugOutput) eZLog::write("key {$key}'s prefix matches");
                        $recordedMatchedPrefixes[] = $key;
                    }
                }

                switch (true) {
                    // if the use's set to use OTP as multifactor
                    case ($userUseOTP4MultiFactor == 1):
                        if ($debugOutput) eZLog::write("Multifactor: {$userUseOTP4MultiFactor}");
                        // if no key was submitted then don't allow login
                        if (empty($YubiKey)) $user = self::REQUIRE_MULTIFACTOR;
                        // else return false to continue with the next login handler
                        else $user = false;
                        break;

                    // if there is an OTP recorded and not set to multifactor but no YubiKey submitted then don't allow login
                    case (count($userRecordedYubiKeyOTPArray) && empty($YubiKey)):
                        if ($debugOutput) eZLog::write("OTP set, no multifactor, no YubiKey received");
                        $user = self::REQUIRE_YUBIKEY_OTP;
                        break;

                    /*
                           Don't allow login in using YubiKey if
                                   - if YubiKey is empty
                           - if there are no matching recorded keys in the profile
                                   - if no YubiKey OTP has been recorded in profile
                           */
                    case (empty($YubiKey)):
                    case (empty($recordedMatchedPrefixes)):
                    case (!count($userRecordedYubiKeyOTP)):
                        if ($debugOutput) eZLog::write("Auth denied");
                        $user = false;
                        break;

                    default:
                        if ($debugOutput) eZLog::write("Looks OK!");
                        break;
                }

                return $user;
    }

}
