<?php
/**
 * Created by JetBrains PhpStorm.
 * User: frank
 * Date: 07.04.12
 * Time: 18:56
 * To change this template use File | Settings | File Templates.
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
