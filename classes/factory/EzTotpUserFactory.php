<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.1 unstable/development
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

class EzTotpUserFactory extends EzTotpFactoryAbstract
{
    /**
     * @var EzTotpUser
     */
    private $otpUser;

    /**
     * Nothing to do
     */
    protected function init()
    {

    }

    /**
     * @param int $id
     * @return EzTotpUser|null
     */
    public function getUserById($id)
    {
        $id = (int)$id;
        return EzTotpUser::fetch($id);
    }

    /**
     * @param string $name
     * @return EzTotpUser|null
     */
    public function fetchByName($name)
    {
        return EzTotpUser::fetchByName($name);
    }

    /**
     * @deprecated
     * @throws EzTotpFactoryException
     */
    public function enableTotpAuthentication()
    {
        if (!$this->otpUser instanceof EzTotpUser) {
            throw new EzTotpFactoryException("No valid user! Please use " . __CLASS__ . "::setUserById first!");
        }

        $this->otpUser->enableOtpAuth();
    }

    public function resetTotpSeed($user)
    {
        if(is_int($user))
        {
            $user = $this->getUserById($user);
        }

        if(! $user instanceof EzTotpUser)
        {
            throw new EzTotpUserException("No valid user given!");
        }


    }

    public function fetchUserListByState($state, $limit = false, $offset = false)
    {
        if (($state !== EzTotpConfiguration::USER_STATE_OTP) and
            ($state !== EzTotpConfiguration::USER_STATE_NOOTP) and
                ($state !== EzTotpConfiguration::USER_STATE_BLOCKED)
        ) {
            throw new EzTotpUserException("Invalid user state!");
        }

        // set parameters
        $parameters = array();
        if ($offset) {
            $parameters['offset'] = (int)$offset;
        }
        if ($limit) {
            $parameters['limit'] = (int)$limit;
        }

        // set query
        $sql = "SELECT *
        FROM eztotp_user
        WHERE state = '" . $state . "'";

        // database transaction
        $db = eZDB::instance();
        $rows = $db->arrayQuery($sql, $parameters);
        $list = array();
        foreach ($rows as $row)
        {
            $persistantObject = new EzTotpUserPersistentObject($row);
            $list[] = $this->eztotpUserPersistantObjectToEzTotpUser($persistantObject);
        }

        return $list;
    }

    public function fetchUserList($limit = false, $offset = false)
        {

            $userContentObjects = eZUser::fetchContentList();

            $list = array();
            foreach ($userContentObjects as $userContentObject)
            {
                if($userContentObject["id"] == eZUser::anonymousId())
                {
                    continue;
                }

                $list[] = $this->getUserById($userContentObject["id"]);
            }

            return $list;
        }

    private function eztotpUserPersistantObjectToEzTotpUser(EzTotpUserPersistentObject $persistantObject)
    {
        if ((!$persistantObject instanceof EzTotpUserPersistentObject) or
            (empty($persistantObject->EzUserId))
        ) {
            throw new EzTotpPersistanceException("Invalid persistant Object given or something wrong with the database!");
        }

        $userId = (int)$persistantObject->EzUserId;

        return $this->getUserById($userId);
    }

}
