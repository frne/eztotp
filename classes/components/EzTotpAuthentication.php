<?php
/**
 * EzTotp: Two-way authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.1 unstable/development
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

class EzTotpAuthentication extends EzTotpAuthenticationHelperAbstract
{
    const KEY_REGENRATION = 30; // Interval between key regeneration
    const OTP_LENGTH = 6; // Length of the Token generated

    private $initialisationKey = false;
    private $secretKey = false;
    private $timestamp = false;


    public function __construct()
    {
        // TODO: Refactor

        /**
        $initialisationKey = "asludhalsduhadashudöahdal";

        if (is_string($initialisationKey)) {
            $this->initialisationKey = $initialisationKey;
        }
        else
        {
            throw new EzTotpAuthenticationException("No valid initialisation key provided!");
        }

        $this->timestamp = $this->get_timestamp();
        $this->secretKey = $this->base32_decode($this->initialisationKey);
         */
    }

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
        return floor(microtime(true) / self::KEY_REGENRATION);
    }


    /**
     * Takes the secret key and the timestamp and returns the one time
     * password.
     *
     * @param binary $key - Secret key in binary form.
     * @param integer $counter - Timestamp as returned by get_timestamp.
     * @return string
     **/
    private function oath_hotp($key, $counter)
    {
        if (strlen($key) < 8)
            throw new Exception('Secret key is too short. Must be at least 16 base 32 characters');

        $bin_counter = pack('N*', 0) . pack('N*', $counter); // Counter must be 64-bit int
        $hash = hash_hmac('sha1', $bin_counter, $key, true);

        return str_pad($this->oath_truncate($hash), self::OTP_LENGTH, '0', STR_PAD_LEFT);
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
     **/
    public function verify($key, $window = 4, $useTimeStamp = true)
    {

        $timeStamp = $this->get_timestamp();

        if ($useTimeStamp !== true) $timeStamp = (int)$useTimeStamp;

        $binarySeed = $this->base32_decode($this->initialisationKey);

        for ($ts = $timeStamp - $window; $ts <= $timeStamp + $window; $ts++)
            if ($this->oath_hotp($binarySeed, $ts) == $key)
                return true;

        return false;

    }

    /**
     * Extracts the OTP from the SHA1 hash.
     * @param binary $hash
     * @return integer
     **/
    private function oath_truncate($hash)
    {
        $offset = ord($hash[19]) & 0xf;

        return (
            ((ord($hash[$offset + 0]) & 0x7f) << 24) |
                ((ord($hash[$offset + 1]) & 0xff) << 16) |
                ((ord($hash[$offset + 2]) & 0xff) << 8) |
                (ord($hash[$offset + 3]) & 0xff)
        ) % pow(10, self::OTP_LENGTH);
    }
}
