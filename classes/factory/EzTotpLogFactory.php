<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.2
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

/**
 * Class EzTotpQrCode
 */
class EzTotpLogFactory extends EzTotpFactoryAbstract
{

    /**
     * @var EzTotpAuthentication
     */
    private $log;

    /**
     * Nothing to init
     */
    protected function init()
    {
    }

    private function log($type, $level, $message, $userId = null)
    {
        if($userId !== null)
        {
            $userObject = eZUser::fetch($userId);
            if(!$userObject instanceof eZUser)
            {
                $userId = null;
            }
        }

        $configurationConstants = $this->_config->getConstants();
        var_dump($configurationConstants);
        die();


        $logObject = EzTotpLogPersistentObject::create($type, $level, $message, $userId);
        $logObject->store();
    }
}
