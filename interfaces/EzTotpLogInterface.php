<?php
/**
 * Created by JetBrains PhpStorm.
 * User: frank
 * Date: 07.04.12
 * Time: 19:00
 * To change this template use File | Settings | File Templates.
 */
interface EzTotpLogInterface
{
    public function write($type, $level, $message, $userId = null);
}
