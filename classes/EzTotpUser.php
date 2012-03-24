<?php
/**
 * EzTotp: Two-way authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.1 unstable/development
 * @author Frank Neff <fneff89@gmail.com>
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
    public function setOtpObject($object)
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
        static $definition = array('fields' => array('contentobject_id' => array('name' => 'ContentObjectID',
            'datatype' => 'integer',
            'default' => 0,
            'required' => true,
            'foreign_class' => 'eZContentObject',
            'foreign_attribute' => 'id',
            'multiplicity' => '0..1'),
            'login' => array('name' => 'Login',
                'datatype' => 'string',
                'default' => '',
                'required' => true),
            'email' => array('name' => 'Email',
                'datatype' => 'string',
                'default' => '',
                'required' => true),
            'password_hash' => array('name' => 'PasswordHash',
                'datatype' => 'string',
                'default' => '',
                'required' => true),
            'password_hash_type' => array('name' => 'PasswordHashType',
                'datatype' => 'integer',
                'default' => 1,
                'required' => true)),
            'keys' => array('contentobject_id'),
            'sort' => array('contentobject_id' => 'asc'),
            'function_attributes' => array('contentobject' => 'contentObject',
                'groups' => 'groups',
                'has_stored_login' => 'hasStoredLogin',
                'original_password' => 'originalPassword',
                'original_password_confirm' => 'originalPasswordConfirm',
                'roles' => 'roles',
                'role_id_list' => 'roleIDList',
                'limited_assignment_value_list' => 'limitValueList',
                'is_logged_in' => 'isLoggedIn',
                'is_enabled' => 'isEnabled',
                'is_locked' => 'isLocked',
                'last_visit' => 'lastVisit',
                'login_count' => 'loginCount',
                'has_manage_locations' => 'hasManageLocations'),
            'relations' => array('contentobject_id' => array('class' => 'ezcontentobject',
                'field' => 'id')),
            'class_name' => 'EzTotpUser',
            'name' => 'ezuser');
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

        $instance->setOtpObject(EzTotpUserPersistentObject::fetch($id));

        return $instance;
    }

    /**
     * @static
     * @param int $id
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
            array( 'LOWER( login )' => strtolower( $login ) ),
            $asObject
        );

        // TODO: setOtpObject
        // $instance->setOtpObject(EzTotpUserPersistentObject::fetch($id));


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

        // TODO: setOtpObject
        //$instance->setOtpObject(EzTotpUserPersistentObject::fetch($id));

        return $instance;
    }


}