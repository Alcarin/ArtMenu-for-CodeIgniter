<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Artisteer 4 utilize 2 menu identified by theyr CSS classes: hmenu (horizontal menu, class="art-hmenu") and vmenu (vertical menu, class="art-vmenu")
 * in this config file you can configure the arrays taht will be used to build the menu.
 * Each menu is an associative array, the keys are used to modify on the fly the array (for example to set a menu item as "selected").
 * Each item in a menu array, is an associative array with the following keys:
 * 
 * 		label: this is the text printed on the menu item
 * 
 * 		url: this is the link pointed by the menu item 
 *  
 * 		items: is an associative array that define submenu items (items options are the same)
 * 
 * 		active: can be TRUE or FALSE, if TRUE let the menu item printed as selected/active. Set this to TRUE only if you want to render the menu item selected by default. Usually is not needed to be declared.
 * 
 */

$config['hmenu']= array(
 					'home' => array('label' => 'Home', 'url' => '/', 'items' => array(
 						'subpage1' => array('label' => 'Subpage 1', 'url' => '/page/sub1'),
 						'subpage2' => array('label' => 'Subpage 2', 'url' => '/page/sub2'),
 						'subpage3' => array('label' => 'Subpage 3', 'url' => '/page/sub3'))),
 					'login' => array('label' => 'Login', 'url' => '/user/login' ),
  					'credits' => array('label' => 'Credits', 'url' => '/page/credits' )					
 					);
					
$config['vmenu']= array(
 					'home' => array('label' => 'Home', 'url' => '/', 'items' => array(
 						'subpage1' => array('label' => 'Subpage 1', 'url' => '/page/sub1'),
 						'subpage2' => array('label' => 'Subpage 2', 'url' => '/page/sub2'),
 						'subpage3' => array('label' => 'Subpage 3', 'url' => '/page/sub3'))),
 					'login' => array('label' => 'Login', 'url' => '/user/login' ),
  					'credits' => array('label' => 'Credits', 'url' => '/page/credits' )					
 					);