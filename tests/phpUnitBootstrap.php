<?php
/**
 * File containing the runtests CLI script
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 * @package tests
 */

set_time_limit( 0 );

// run unit test in the eZPublish root
chdir(getcwd() . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR);

// autoload ez_kernel
require_once("autoload.php");
