<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.3
 * @author Frank Neff <frankneff.ch>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

abstract class EzTotpFactoryAbstract
{
    /**
     * @var EzTotpFactory
     */
    protected $_factory;

    /**
     * @var EzTotpConfiguration
     */
    protected $_config;

    /**
     * @param EzTotpFactory $factory
     */
    final public function __construct(EzTotpFactory $factory )
    {
        if(!$factory instanceof EzTotpFactory)
        {
            throw new EzTotpFactoryException("Param factory must be instanceof EzTotpFactory! Please use the EzTotpFactory->load() to get subFactory instance!");
        }

        $this->_factory = $factory;
        $this->_config = $factory->getConfig();
    }

    /**
     * Initialize function to implement constructor stuff
     *
     * @abstract
     */
    abstract protected function init();
}
