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
 * Class EzTotpFactory
 */
class EzTotpFactory
{
    private $config;

    private $user;

    public function __construct( EzTotpConfiguration $config, EzTotpUser $user = null )
    {
        $this->config = $config;
        if($user)
        {
            $this->user = $user;
        }
    }

    public function setUser(EzTotpUser $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getConfig()
    {
        return $this->config;
    }

}
