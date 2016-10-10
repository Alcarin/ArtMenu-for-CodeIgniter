<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * THIS CONTROLLER CONTAINS ONLY USAGE EXAMPLES!
 */

class Page extends CI_Controller {
	
	public function index()
	{
		
		//FIRST LOAD THE LIBRARY
		$this->load->library('art_menu');
		
		//WE ARE COMPETLY OVERRIDING THE VMENU FOR THIS PAGE 
		$this->art_menu->vmenu=array(
 					'home' => array('label' => 'Home', 'url' => '/', 'items' => array(
 						'subpage1' => array('label' => 'Subpage 1', 'url' => '/page/sub1','items'=>array('login' => array('label' => 'Login', 'url' => '/user/login' ),
  					'credits' => array('label' => 'Credits', 'url' => '/page/credits', 'items'=>array('login' => array('label' => 'Login', 'url' => '/user/login' ),
  					'credits' => array('label' => 'Credits', 'url' => '/page/credits' )	))	)),
 						'subpage2' => array('label' => 'Subpage 2', 'url' => '/page/sub2'),
 						'subpage3' => array('label' => 'Subpage 3', 'url' => '/page/sub3'))),
 					'login' => array('label' => 'Login', 'url' => '/user/login' ),
  					'credits' => array('label' => 'Credits', 'url' => '/page/credits' )					
 					);
		//FOR THIS PAGE WE ARE MODIFYING THE LABEL OF AN ITEM
		$this->art_menu->Hmenu['home']['items']['subpage3']['label']='Subpage 4';
		
		//NOW WE HAVE TO RENDER THE MENU
		$data['hmenu']=$this->art_menu->rendermenu('hmenu');
		//THE SECOND PARAMETER IS USED TO RENDER MENU ITEMS AS "ACTIVE"
		$data['vmenu']=$this->art_menu->rendermenu('vmenu','home/subpage1/credits/login/');
		
		//FINALLY WE HAVE TO RENDER A VIEW PASSING RENDERED MENU TO IT
		$this->load->view('page',$data); 
		
		
	}


	
}


