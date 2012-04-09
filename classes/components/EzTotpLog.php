<?php
/**
 * Created by JetBrains PhpStorm.
 * User: frank
 * Date: 07.04.12
 * Time: 19:05
 * To change this template use File | Settings | File Templates.
 */
class EzTotpLog
{
    private $config;

    private $logInstance;

    public function __construct(EzTotpConfiguration $config)
    {
        $this->config = $config;
    }

    /**
     * @param $type
     * @param $level
     * @param $message
     * @param null $userId
     * @return bool
     * @throws EzTotpLogException
     */
    public function write($type, $level, $message, $userId = null)
    {

        if ($this->config->log["log"] != "enabled") {
            return false;
        }

        if ($userId !== null) {
            $userObject = eZUser::fetch($userId);
            if (!$userObject instanceof eZUser) {
                $userId = null;
            }
        }

        switch ($level)
        {
            case EzTotpConfiguration::LOG_LEVEL_FATAL:
            case EzTotpConfiguration::LOG_LEVEL_INFO:
            case EzTotpConfiguration::LOG_LEVEL_WARN:
                break;

            default:
                throw new EzTotpLogException("No valid log level!");
                break;
        }

        switch ($type)
        {
            case EzTotpConfiguration::LOG_TYPE_HILEVEL:
                if ($this->logTypeEnabled("hilevel")) {
                    $this->logInstance = new EzTotpLogHilevel();
                }
                break;

            case EzTotpConfiguration::LOG_TYPE_ACCESS:
                if ($this->logTypeEnabled("access")) {
                    $this->logInstance = new EzTotpLogAccess();
                }
                break;
            case EzTotpConfiguration::LOG_TYPE_ERROR:
                if ($this->logTypeEnabled("error")) {
                    $this->logInstance = new EzTotpLogError();
                }
                break;

            default:
                throw new EzTotpLogException("No valid log type!");
                break;
        }

        if (!$this->logInstance instanceof EzTotpLogInterface) {
            throw new EzTotpLogException("Logger has to implement EzTotpLogInterface!");
        }

        return $this->logInstance->write($type, $level, $message, $userId);
    }

    /**
     * @param string $type
     * @return bool
     */
    private function logTypeEnabled($type)
    {
        if ((array_key_exists($type, $this->config->log["logType"])) and
            ($this->config->log["logType"][$type] == "enabled")
        ) {
            return true;
        }
        return false;
    }

    public function getListByType($type, $limit = 0, $offset = 0)
    {


        // set parameters
        $parameters = array();
        if ($offset > 0) {
            $parameters['offset'] = (int)$offset;
        }
        if ($limit > 0) {
            $parameters['limit'] = (int)$limit;
        }


        // set query
        $sql = "SELECT *
                FROM eztotp_log
                WHERE type = '" . $type . "' ORDER BY timestamp DESC";

        // database transaction
        $db = eZDB::instance();
        $rows = $db->arrayQuery($sql, $parameters);
        $list = array();

        foreach ($rows as $row)
        {
            $list[] = array(
                "id" => $row['id'],
                "time" => date("D, M j, Y - G:i:s", $row['timestamp']),
                "user" => array(
                    "id" => $row['user_id'],
                    "ip" => $row['ip_address']
                ),
                "level" => $row['level'],
                "message" => $row['message']

            );
        }

        return $list;
    }
}
