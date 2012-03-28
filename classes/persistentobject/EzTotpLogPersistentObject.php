<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.1 unstable/development
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

/**
 * Class EzTotpUserPersistentObject
 */
class EzTotpUserPersistentObject extends eZPersistentObject
{
    /**
     * @var int
     */
    protected $EzUserId;

    /**
     * @var string
     */
    public $State;

    /**
     * @var integer
     */
    public $OtpSeed;

    /**
     * @return array
     */
    public static function definition()
    {
        return array(
            "fields" => array(
                "ezuser_id" => array(
                    "name" => "EzUserId",
                    "datatype" => "integer",
                    "default" => 0,
                    "required" => true
                ),
                "state" => array(
                    "name" => "State",
                    "datatype" => "integer",
                    "default" => 0,
                    "required" => false
                ),
                "otp_seed" => array(
                    "name" => "OtpSeed",
                    "datatype" => "string",
                    "default" => "",
                    "required" => true
                )
            ),
            "function_attributes" => array(),
            "increment_key" => "id",
            "keys" => array("id", "ezuser_id"),
            "class_name" => __CLASS__,
            "name" => "eztotp_user"
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
     * @param int $ezUserId
     * @param bool $asObject
     * @return array|eZPersistentObject|null
     */
    public static function fetch($ezUserId, $asObject = true)
    {
        return self::fetchObject(
            self::definition(),
            null,
            array("ezuser_id" => (string)$ezUserId),
            (bool)$asObject
        );
    }

    /**
     * @static
     * @param int $state
     * @param bool $asObject
     * @return array|eZPersistentObject|null
     */
    public static function fetchByState($state, $asObject = true)
    {
        return self::fetchObject(
            self::definition(),
            null,
            array("state" => (int)$state)
        );
    }

    /**
     * @static
     * @param int $ezUserId
     * @param int $state
     * @param string $otpSeed
     * @return EzTotpUserPersistentObject
     * @throws EzTotpPersistanceException
     */
    private static function create( $ezUserId, $state = 1, $otpSeed)
    {
        if(!is_string($otpSeed) or strlen($otpSeed) < 20)
        {
            throw new EzTotpPersistanceException("Invalid initialSeed given. Cannot create persistent object.");
        }

        $row = array(
            "ezuser_id" => $ezUserId,
            "state" => $state,
            "otp_seed" => $otpSeed
        );
        return new self($row);
    }
}
