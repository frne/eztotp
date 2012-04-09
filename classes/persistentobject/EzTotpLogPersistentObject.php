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
 * Class EzTotpLogPersistentObject
 */
class EzTotpLogPersistentObject extends eZPersistentObject
{
    /**
     * @var int
     */
    public $LogId;

    /**
     * @var int
     */
    public $UserId;

    /**
     * @var string
     */
    public $Type;

    /**
     * @var integer
     */
    public $Level;

    /**
     * @var integer
     */
    public $IpAddess;

    /**
     * @var integer
     */
    public $Message;

    /**
     * @return array
     */
    public static function definition()
    {
        return array(
            "fields" => array(
                "id" => array(
                    "name" => "Id",
                    "datatype" => "int",
                    "default" => 0,
                    "required" => true
                ),
                "log_id" => array(
                    "name" => "LogId",
                    "datatype" => "string",
                    "default" => 0,
                    "required" => true
                ),
                "user_id" => array(
                    "name" => "UserId",
                    "datatype" => "integer",
                    "default" => 0,
                    "required" => true
                ),
                "type" => array(
                    "name" => "Type",
                    "datatype" => "integer",
                    "default" => 0,
                    "required" => false
                ),
                "level" => array(
                    "name" => "Level",
                    "datatype" => "integer",
                    "default" => "",
                    "required" => true
                ),
                "timestamp" => array(
                    "name" => "Timestamp",
                    "datatype" => "integer",
                    "default" => "",
                    "required" => true
                ),
                "ip_address" => array(
                    "name" => "IpAddress",
                    "datatype" => "string",
                    "default" => "",
                    "required" => true
                ),
                "message" => array(
                    "name" => "Message",
                    "datatype" => "string",
                    "default" => "",
                    "required" => true
                )
            ),
            "function_attributes" => array(),
            "keys" => array("id"),
            "increment_key" => "id",
            "class_name" => __CLASS__,
            "name" => "eztotp_log"

        );
    }

    /**
     * @param array $row
     */
    protected function __construct($row = array())
    {
        parent::__construct($row);
    }


    /**
     * @static
     * @param int $Id
     * @param bool $asObject
     * @return EzTotpLogPersistentObject|null
     */
    public static function fetch($Id, $asObject = true)
    {
        $object = self::fetchObject(
            self::definition(),
            null,
            array("log_id" => (string)$Id),
            (bool)$asObject
        );
        return $object;
    }

    /**
     * @static
     * @param $Type
     * @param $Level
     * @param EzTotpLogData $Data
     * @return EzTotpLogPersistentObject
     * @throws EzTotpLogException
     */
    public static function create($Type, $Level, $Message = "", $UserId = false)
    {
        if (!is_int((int)$Type)) {
            throw new EzTotpLogException("Type has to be int!");
        }

        if (!is_int((int)$Level)) {
            throw new EzTotpLogException("Level has to be int!");
        }

        if (!is_int((int)$UserId)) {
            throw new EzTotpLogException("UserId has to be int!");
        }

        $id = uniqid("log_", true);

        $row = array(
            "log_id" => $id,
            "user_id" => $UserId,
            "type" => $Type,
            "level" => $Level,
            "timestamp" => time(),
            "ip_address" => $_SERVER['REMOTE_ADDR'],
            "message" => $Message
        );

        return new self($row);
    }
}
