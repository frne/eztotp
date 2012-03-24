<?php

$Module = array( 'name' => 'eZTotp', 'variable_params' => true );

$ViewList = array();
$ViewList['test'] = array(
    'functions' => array( 'test' ),
    'script' => 'test.php',
    'params' => array());

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
