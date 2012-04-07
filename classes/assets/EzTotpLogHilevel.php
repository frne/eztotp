<?php
/**
 * Created by JetBrains PhpStorm.
 * User: frank
 * Date: 07.04.12
 * Time: 18:56
 * To change this template use File | Settings | File Templates.
 */
class EzTotpLogHilevel implements EzTotpLogInterface
{
    public function write($type, $level, $message, $userId = null)
    {

        $logObject = EzTotpLogPersistentObject::create(
            EzTotpConfiguration::LOG_TYPE_HILEVEL,
            $level,
            $message,
            $userId
        );
        $logObject->store();
    }
}
