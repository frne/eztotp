<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.2
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

class EzTotpLogAccess implements EzTotpLogInterface
{
    public function write($type, $level, $message, $userId = null)
    {
        $logObject = EzTotpLogPersistentObject::create(
            EzTotpConfiguration::LOG_TYPE_ACCESS,
            $level,
            $this->getMessageAsHtml($message, $userId),
            $userId
        );
        $logObject->store();
    }

    private function getMessageAsHtml($message, $userId)
    {
        // get ini
        $ini = eZINI::instance("eztotp.ini");

        // create configuration
        $configuration = new EzTotpConfiguration();
        $configuration->loadConfiguration($ini);


        // create factory
        $factory = new EzTotpFactory($configuration);
        $userFactory = $factory->load("user");

        $user = $userFactory->getUserById($userId);
        if(! $user instanceof EzTotpUser)
        {
            $user = $userFactory->getUserById(eZUser::anonymousId());
        }


        $userDataMap = $user->attribute("contentobject")->attribute("data_map");

        $tpl = eZTemplate::factory();
        $tpl->setVariable("message", $message);
        $tpl->setVariable("userdata", array(
            "login" => $user->Login,
            "email" => $user->Email,
            "name" => $userDataMap["first_name"]->Content() . " " . $userDataMap["last_name"]->Content(),
            "lastvisit" => date("D, M j, Y - G:i:s", $user->lastVisit()),
            "attributes" => $user->attributes()
        ));

        $html = $tpl->fetch( 'design:eztotp/helper/logAccessMessage.tpl');


        $doc = new DOMDocument();
        $doc->loadHTML($html);
        $doc->normalizeDocument();
        return $doc->saveHTML();
    }
}
