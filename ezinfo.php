<?php
/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.2
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

class EzTotpInfo
{
    static function info()
    {
        return array(
            'Name' => "EzTotp: Two-factor authentication with Google Authenticator for eZPublish",
            'Version' => "0.2",
            'Author' => "Frank Neff <a href='http://www.frankneff.ch'>www.frankneff.ch</a>",
            'Copyright' => "Copyright (C) 2012 Frank Neff",
            'License' => "Lesser GNu Public License - LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html",
            'Includes the following third-party software' => array( 'Name' => 'Google TOTP Two-factor Authentication for PHP',
                                                                    'Version' => '1.0',
                                                                    'License' => "GPL v3",
                                                                    'For more information' => 'http://www.idontplaydarts.com/2011/07/google-totp-two-factor-authentication-for-php/' )
        );
    }
}
?>