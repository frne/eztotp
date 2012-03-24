<?php
/**
 * Test module for the class
 *
 * @access public
 * @author ymc-frne <frank.neff@ymc.ch>
 * @license ymc standard license <license@ymc.ch>
 * @since 2012/03/23
 */

// wire up for eZTotop
$configuration = new EzTotpConfiguration("development");
$user = new EzTotpUser();
$factory = new EzTotpFactory($configuration, $user);


$currentUser = eZUser::currentUser();
$factory->getUser()->setEzUserObject($currentUser);

echo "<pre>";

var_dump($factory);

echo "</pre>";

eZExecution::cleanExit();
