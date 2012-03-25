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
 * Class EzTotpFactory
 */
class EzTotpFactory
{
    private $config;

    public function __construct(EzTotpConfiguration $config)
    {
        $this->config = $config;
    }

    public function load($type)
    {
        $factories = $this->getAvailableFactories();

        if (array_key_exists($type, $factories)) {
            $factoryName = $factories[$type];
            $factory = new $factoryName($this);

            if(!$factory instanceof EzTotpFactoryAbstract)
            {
                throw new EzTotpFactoryException("No valid factory: $factoryName! Please extend EzTotpFactoryAbstract!");
            }

            return $factory;

        }
        else
        {
            throw new EzTotpFactoryException("Factory configuration for type '" . $type . "' does not exist!");
        }

    }

    public function getConfig()
    {
        return $this->config;
    }

    private function getAvailableFactories()
    {
        if( !isset($this->config->factory) )
        {
            throw new EzTotpConfigurationException("Configuration fail! No availableFactories found in eztotp.ini.");
        }

        return $this->config->factory["availableFactories"];
    }


}
