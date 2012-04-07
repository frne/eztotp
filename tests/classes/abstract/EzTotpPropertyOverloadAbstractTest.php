<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.2
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

/**
 * Test class for EzTotpPropertyOverloadAbstract.
 * Generated by PHPUnit on 2012-04-06 at 22:39:50.
 */
class EzTotpPropertyOverloadAbstractTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var EzTotpPropertyOverloadAbstract
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new EzTotpConfiguration;
        $this->object->foo = "foo";
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers EzTotpPropertyOverloadAbstract::__set
     */
    public function test__set()
    {
        $this->object->propertyExample = "bar";

        $this->assertArrayHasKey("propertyExample", $this->object->getData());
        $this->assertEquals($this->object->propertyExample, "bar");

        try {
            $this->object->propertyExample = null;
            $result = false;
        }
        catch (Exception $e)
        {
            $result = true;
        }
        $this->assertTrue($result);
    }

    /**
     * @covers EzTotpPropertyOverloadAbstract::__get
     */
    public function test__get()
    {
        $this->object->propertyExample = "bar";
        $this->assertEquals($this->object->foo, "foo");

        try {
            $value = $this->object->nonExistantValue;
            $result = false;
        }
        catch (Exception $e)
        {
            $result = true;
        }
        $this->assertTrue($result);
    }

    /**
     * @covers EzTotpPropertyOverloadAbstract::__isset
     */
    public function test__isset()
    {
        $this->assertTrue(isset($this->object->foo));
        $this->assertFalse(isset($this->object->nonExistantValue));
    }

    /**
     * @covers EzTotpPropertyOverloadAbstract::__unset
     */
    public function test__unset()
    {
        $this->object->testUnsetValue = "foo";
        $this->assertEquals($this->object->testUnsetValue, "foo");
        unset($this->object->testUnsetValue);
        $this->assertFalse(isset($this->object->testUnsetValue));
    }
}

?>