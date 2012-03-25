<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.1 unstable/development
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

abstract class EzTotpAuthenticationHelperAbstract
{
    /**
     * Array needed by the base32 encoder
     *
     * @var array
     * @access protected
     */
    protected static $lut = array( // Lookup needed for Base32 encoding
        "A" => 0, "B" => 1, "C" => 2, "D" => 3, "E" => 4, "F" => 5, "G" => 6, "H" => 7, "I" => 8, "J" => 9,
        "K" => 10, "L" => 11, "M" => 12, "N" => 13, "O" => 14, "P" => 15, "Q" => 16, "R" => 17, "S" => 18, "T" => 19,
        "U" => 20, "V" => 21, "W" => 22, "X" => 23, "Y" => 24, "Z" => 25, "2" => 26, "3" => 27, "4" => 28, "5" => 29,
        "6" => 30, "7" => 31
    );

    /**
     * Decodes a base32 string into a binary string.
     **/
    protected static function base32_decode($b32)
    {
        $b32 = strtoupper($b32);

        if (!preg_match('/^[ABCDEFGHIJKLMNOPQRSTUVWXYZ234567]+$/', $b32, $match))
            throw new Exception('Invalid characters in the base32 string.');

        $l = strlen($b32);
        $n = 0;
        $j = 0;
        $binary = "";

        for ($i = 0; $i < $l; $i++) {

            $n = $n << 5; // Move buffer left by 5 to make room
            $n = $n + self::$lut[$b32[$i]]; // Add value into buffer
            $j = $j + 5; // Keep track of number of bits in buffer

            if ($j >= 8) {
                $j = $j - 8;
                $binary .= chr(($n & (0xFF << $j)) >> $j);
            }
        }

        return $binary;
    }

    /**
     * Generates a 16 digit secret key in base32 format
     * @return string
     **/
    public static function generate_secret_key($length = 30)
    {
        $b32 = "234567QWERTYUIOPASDFGHJKLZXCVBNM";
        $s = "";

        for ($i = 0; $i < $length; $i++)
            $s .= $b32[rand(0, 31)];

        return $s;
    }


}
