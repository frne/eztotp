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
 * Authentication component class
 *
 * Based on "Google TOTP Two-factor Authentication for PHP" by Phil
 * @see http://www.idontplaydarts.com/2011/07/google-totp-two-factor-authentication-for-php/
 */
class EzTotpAuthentication extends EzTotpAuthenticationHelperAbstract
{
    /**
     * @var EzTotpConfiguration
     */
    private $conf;

    /**
     * @var string
     */
    private $initialisationKey = false;

    /**
     * @var string
     */
    private $secretKey = false;

    /**
     * @var int
     */
    private $timestamp = false;

    /**
     * @param EzTotpConfiguration $conf
     */
    public function __construct(EzTotpConfiguration $conf)
    {
        $this->conf = $conf;
    }

    /**
     * @param int $initialisationKey
     * @throws EzTotpAuthenticationException
     */
    public function setInitialisationSeed($initialisationKey)
    {
        if (is_string($initialisationKey)) {
            $this->initialisationKey = $initialisationKey;
        }
        else
        {
            throw new EzTotpAuthenticationException("No valid initialisation key provided!");
        }

        $this->timestamp = $this->get_timestamp();
        $this->secretKey = $this->base32_decode($this->initialisationKey);
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->oath_hotp($this->secretKey, $this->timestamp);
    }

    /**
     * Returns the current Unix Timestamp devided by the KEY_REGENRATION
     * period.
     * @return integer
     **/
    private function get_timestamp()
    {
        return floor(microtime(true) / $this->conf->base["keyRegenerationInterval"]);
    }


    /**
     * Takes the secret key and the timestamp and returns the one time
     * password.
     *
     * @param binary $key - Secret key in binary form.
     * @param integer $counter - Timestamp as returned by get_timestamp.
     * @return string
     */
    private function oath_hotp($key, $counter)
    {
        if (strlen($key) < 8)
            throw new Exception('Secret key is too short. Must be at least 16 base 32 characters');

        $bin_counter = pack('N*', 0) . pack('N*', $counter); // Counter must be 64-bit int
        $hash = hash_hmac('sha1', $bin_counter, $key, true);

        return str_pad($this->oath_truncate($hash), $this->conf->base["keyLength"], '0', STR_PAD_LEFT);
    }

    /**
     * Verifys a user inputted key against the current timestamp. Checks $window
     * keys either side of the timestamp.
     *
     * @param string $b32seed
     * @param string $key - User specified key
     * @param integer $window
     * @param boolean $useTimeStamp
     * @return boolean
     */
    public function verify($key, $window = 4, $useTimeStamp = true)
    {

        $timeStamp = $this->get_timestamp();

        if ($useTimeStamp !== true) $timeStamp = (int)$useTimeStamp;

        $binarySeed = $this->base32_decode($this->initialisationKey);

        for ($ts = $timeStamp - $this->conf->base["timeShiftTolerance"];
             $ts <= $timeStamp + $this->conf->base["timeShiftTolerance"];
             $ts++)
        {
            if ($this->oath_hotp($binarySeed, $ts) == $key)
            {
                return true;
            }
        }
        return false;
    }

    /**
     * Extracts the OTP from the SHA1 hash.
     * @param binary $hash
     * @return integer
     */
    private function oath_truncate($hash)
    {
        $offset = ord($hash[19]) & 0xf;

        return (
            ((ord($hash[$offset + 0]) & 0x7f) << 24) |
                ((ord($hash[$offset + 1]) & 0xff) << 16) |
                ((ord($hash[$offset + 2]) & 0xff) << 8) |
                (ord($hash[$offset + 3]) & 0xff)
        ) % pow(10, $this->conf->base["keyLength"]);
    }
}
