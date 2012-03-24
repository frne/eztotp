/**
 * EzTotp: Two-way authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.1 unstable/development
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

/**
 * Schema for EzTotpUserPersistentObject
 */
CREATE TABLE `eztotp_user` (
  `ezuser_id` int(11) NOT NULL,
  `state` int(1),
  `otp_seed` text NOT NULL,
  PRIMARY KEY (`ezuser_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;