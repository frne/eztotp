<?php

require_once 'D:\xampp\htdocs\ezp\extension\eztotp\classes\abstract\EzTotpAuthenticationHelperAbstract.php';

/**
 * Test class for EzTotpAuthenticationHelperAbstract.
 * Generated by PHPUnit on 2012-04-03 at 20:57:13.
 */
class EzTotpAuthenticationHelperAbstractTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var EzTotpAuthenticationHelperAbstract
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $config = new EzTotpConfiguration();
        $config->loadConfiguration();
        $this->object = new EzTotpAuthentication($config);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers EzTotpAuthenticationHelperAbstract::generate_secret_key
     */
    public function testGenerate_secret_key()
    {
        $this->assertEquals(30, strlen($this->object->generate_secret_key(30)));
    }
}

?>
