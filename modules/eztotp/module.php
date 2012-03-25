<?php
/**
 * EzTotp: Two-way authentication with Google Authenticator for eZPublish
 *
 * @package EzTotp
 * @version 0.1 unstable/development
 * @author Frank Neff <fneff89@gmail.com>
 * @license LGPL v3 - http://www.gnu.org/licenses/lgpl-3.0.en.html
 */

$Module = array( 'name' => 'eZTotp', 'variable_params' => true );

$ViewList = array();
$ViewList['test'] = array(
    'functions' => array( 'test' ),
    'script' => 'test.php',
    'params' => array());

$ViewList['login'] = array(
    'functions' => array( 'login' ),
    'script' => 'login.php',
    'ui_context' => 'authentication',
    'default_action' => array( array( 'name' => 'Login',
                                      'type' => 'post',
                                      'parameters' => array( 'Login',
                                                             'Password' ) ) ),
    'single_post_actions' => array( 'LoginButton' => 'Login' ),
    'post_action_parameters' => array( 'Login' => array( 'UserLogin' => 'Login',
                                                         'UserPassword' => 'Password',
							                             'TotpKey' => 'TotpKey',
                                                         'UserRedirectURI' => 'RedirectURI' ) ),
    'params' => array( ) );


/**
$ViewList['elevation_detail'] = array(
    'functions' => array( 'elevate' ),
    'default_navigation_part' => 'ezfindnavigationpart',
    'ui_context' => 'administration',
    'script' => 'elevation_detail.php',
    'params' => array( 'ObjectID' ),
    'unordered_params' => array( 'language'     => 'Language',
                                 'offset'       => 'Offset',
                                 'limit'        => 'Limit',
                                 'search_query' => 'SearchQuery',
                                 'fuzzy_filter' => 'FuzzyFilter' )
                                    );

$ViewList['remove_elevation'] = array(
    'functions' => array( 'elevate' ),
    'default_navigation_part' => 'ezfindnavigationpart',
    'ui_context' => 'administration',
    'script' => 'remove_elevation.php',
    'params' => array( 'ObjectID', 'SearchQuery', 'LanguageCode' )
                                    );
**/
$FunctionList = array();
$FunctionList['auth'] = array();
?>
