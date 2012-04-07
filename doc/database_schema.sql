/**
 * EzTotp: Two-factor authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.2
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

ALTER TABLE eztotp_user ADD INDEX(ezuser_id);

/**
 * Schema for EzTotpLogPersistentObject
 */
CREATE TABLE `eztotp_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_id` text NOT NULL,
  `user_id` int(20),
  `type` int(1),
  `level` int(1),
  `timestamp` int(20),
  `ip_address` text NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;