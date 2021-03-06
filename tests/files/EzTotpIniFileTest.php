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
 * Test class for EzTotpConfiguration.
 * Generated by PHPUnit on 2012-04-03 at 19:48:42.
 */
class EzTotpIniFileTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var EzTotpConfiguration
     */
    protected $object;

    private $settingsFilePath;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->settingsFilePath = __DIR__ . DIRECTORY_SEPARATOR .
            ".." . DIRECTORY_SEPARATOR .
            ".." . DIRECTORY_SEPARATOR .
            "settings" . DIRECTORY_SEPARATOR;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    private function runConfigFileTest($filename)
    {
        $this->assertFileExists($this->settingsFilePath . $filename, "File '$filename' not present!");
    }

    /**
     * @covers EzTotpConfiguration::loadConfiguration
     */
    public function testContentIni()
    {
        $this->runConfigFileTest("content.ini.append.php");
    }


    /**
     * @covers EzTotpConfiguration::loadConfiguration
     */
    public function testDesignIni()
    {
        $this->runConfigFileTest("design.ini.append.php");
    }

    /**
     * @covers EzTotpConfiguration::loadConfiguration
     */
    public function testEztotpIni()
    {
        $this->runConfigFileTest("eztotp.ini");
    }

    /**
     * @covers EzTotpConfiguration::loadConfiguration
     */
    public function testMenuIni()
    {
        $this->runConfigFileTest("menu.ini.append.php");
    }

    /**
     * @covers EzTotpConfiguration::loadConfiguration
     */
    public function testModuleIni()
    {
        $this->runConfigFileTest("module.ini.append.php");
    }

    /**
     * @covers EzTotpConfiguration::loadConfiguration
     */
    public function testOverrideIni()
    {
        $this->runConfigFileTest("override.ini.append.php");
    }

    /**
     * @covers EzTotpConfiguration::loadConfiguration
     */
    public function testSiteIni()
    {
        $this->runConfigFileTest("site.ini.append.php");
    }
}

?>
