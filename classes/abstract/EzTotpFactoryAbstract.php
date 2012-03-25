<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.1 unstable/development
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

abstract class EzTotpFactoryAbstract
{
    protected $_factory;

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
