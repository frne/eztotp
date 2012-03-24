<?php
/**
 * TITLE
 *
 * @access public
 * @author ymc-frne <frank.neff@ymc.ch>
 * @license ymc standard license <license@ymc.ch>
 * @since 2012/03/21
 */

/**
 * Class EzTotpUser
 */
class EzTotpUser
{
    /**
     * @var EzTotpUserPersistentObject
     */
    protected $userPersistentObject;

    /**
     * @var ezUser
     */
    protected $ezUserObject;

    public function __construct()
    {
    }

    /**
     * @param EzTotpUserPersistentObject $persistentUser
     */
    public function setUserPersistentObject( EzTotpUserPersistentObject $persistentUser )
    {
        $this->userPersistentObject = $persistentUser;
    }

    /**
     * @param ezUser $ezUserObject
     */
    public function setEzUserObject( ezUser $ezUserObject )
    {
        $this->ezUserObject = $ezUserObject;
    }

    /**
     * @return bool
     * @throws EzTotpUserException
     */
    private function fetchByUserId( int $id )
    {
        if ( $id == eZUser::anonymousId() )
        {
            throw new EzTotpUserException( "You cannot use anonymous user for TOTP" );
        }

        $this->setEzUserObject( eZUser::fetch( $id ) );
        $this->setUserPersistentObject( EzTotpUserPersistentObject::fetch( $id ) );
    }

    private function getUserPersistentObjectByEzUser()
    {
    }
}
