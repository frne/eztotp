<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.3
 * @author Frank Neff <frankneff.ch>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

/**
 * Class EzTotpUser
 */
class EzTotpUser extends eZUser
{
    /**
     * @var string
     */
    public $otpSeed;

    /**
     * @var int
     */
    public $otpState;

    /**
     * @var EzTotpUserPersistentObject
     */
    public $otpObject;

    /**
     * @param EzTotpUserPersistentObject $object
     */
    public function setOtpObject(EzTotpUserPersistentObject $object)
    {
        $this->otpObject = $object;
        $this->otpSeed = $object->OtpSeed;
        $this->otpState = $object->State;
    }

    /**
     * @static
     * @return array
     */
    static function definition()
    {
        $definition = parent::definition();
        $definition["class_name"] = "EzTotpUser";

        return $definition;
    }

    /**
     * @static
     * @param int $id
     * @param bool $asObject
     * @return EzTotpUser|null
     */
    static function fetch($id, $asObject = true)
    {
        if (!$id) {
            return null;
        }

        $instance = eZPersistentObject::fetchObject(
            self::definition(),
            null,
            array('contentobject_id' => $id),
            $asObject
        );

        if( ($otpObject = EzTotpUserPersistentObject::fetch($instance->id())) instanceof EzTotpUserPersistentObject)
        {
            $instance->setOtpObject($otpObject);
        }

        return $instance;
    }

    /**
     * @static
     * @param int $login
     * @param bool $asObject
     * @return EzTotpUser|null
     */
    static function fetchByName($login, $asObject = true)
    {
        if (!$login) {
            return null;
        }

        $instance = eZPersistentObject::fetchObject(
            self::definition(),
            null,
            array('LOWER( login )' => strtolower($login)),
            $asObject
        );

        if(!$instance instanceof EzTotpUser)
        {
            return null;
        }

        if( ($otpObject = EzTotpUserPersistentObject::fetch( $instance->id() )) instanceof EzTotpUserPersistentObject)
        {
            $instance->setOtpObject($otpObject);
        }

        return $instance;
    }

    /**
     * @static
     * @param int $id
     * @param bool $asObject
     * @return EzTotpUser|null
     */
    static function fetchByEmail($email, $asObject = true)
    {
        if (!$email) {
            return null;
        }

        $instance = eZPersistentObject::fetchObject(
            self::definition(),
            null,
            array('LOWER( email )' => strtolower($email)),
            $asObject
        );

        $instance->setOtpObject(EzTotpUserPersistentObject::fetch($instance->id()));

        return $instance;
    }
}