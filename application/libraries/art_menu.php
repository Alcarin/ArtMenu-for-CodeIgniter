<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 *  Generate the ul tag used by Artisteer 4 to build Horizontal and Vertical menus. Modified version of the _list function of the standard html_helper (made by EllisLab, Inc.) was used to build this library.
 *
 * @package		CodeIgniter
 * @author		Francesco Rubeo <francesco2785@gmail.com>
 * @license		http://codeigniter.com/user_guide/license.html
 * 
 * 
 *  USAGE EXAMPLE:
 * 
 * DECLARE MENU STRUCTURE IN A CONFIG FILE 
 * 
 *  $config['hmenu']= array(
 *					'home' => array('label' => 'Home', 'url' => '/', 'items' => array(
 *						'subpage1' => array('label' => 'Subpage 1', 'url' => '/page/sub1'),
 *						'subpage2' => array('label' => 'Subpage 2', 'url' => '/page/sub2'),
 *						'subpage3' => array('label' => 'Subpage 3', 'url' => '/page/sub3'))),
 *					'login' => array('label' => 'Login', 'url' => '/user/login' ),
 *					'credits' => array('label' => 'Credits', 'url' => '/page/credits' )					
 *					);
 * 
 * 
 * IN A CONTROLLER, LOAD THE LIBRARY, GENERATE THE UL TAG MENU AND SEND THE GENERATED TAG TO A VIEW
 * 
 * 		$this->load->library('art_menu');
 * 		$data['hmenu']=$this->art_menu->rendermenu('hmenu', 'home');  // 'home' is the array item key, and is used to render as "active" the 'home' item in the menu
 * 		$this->load->view('page',$data); 
 * 
 * IN A VIEW, PRINT THE GENERATED <UL> TAG 
 * 
 * 		<?=$hmenu?>
 * 
 * ADVANCED FEATURES:
 * 
 * After loaded the library in the controller you can change the menu specified in the config file momentarily only for that specific controller function modifying the public variables $hmenu and $vmenu:
 * 
 * in example you can change the "login" item with a logout link:
 * $this->art_menu->hmenu['login']['label']='Logout';
 * $this->art_menu->hmenu['login']['url']='/user/logout';
 * 
 * or you can add another menu item, in example for only certain users:
 * $this->art_menu->hmenu['admin']=array('label' => 'Admin', 'url' => '/page/admin')
 * 
 * 
 * The rendermenu function take two parameters:
 *  $type= 'hmenu' or 'vmenu'; 
 *  $item= is a string describing wich menu item is currectly active/selected. The item is identified by the key used in the config file, use / to select submenu items.
 *  		for example to activate "home" menu item you should set $item as "home"; To activate the "Subpage 1" submenu item, $item should be "home/subpage1".
 * 
 * 
 * 
 */
class art_menu {
	
	public $hmenu= array();
	public $vmenu= array();
	
	
	function rendermenu($type,$item=''){
		switch ($type) {
			case 'hmenu':
				if ($item!='') {
					$this->activate($item,$this->hmenu);
				}
				return $this->create('class="art-hmenu"',$this->hmenu);
				break;
			
			case 'vmenu':
				if ($item!='') {
					$this->activate($item,$this->vmenu);
				}
				return $this->create('class="art-vmenu"',$this->vmenu);
				break;
		}
	}
	
	
	function __construct()
    {
		$CI =& get_instance();
		$CI->config->load('art_menu');
		$this->hmenu=$CI->config->item('hmenu');
		$this->vmenu=$CI->config->item('vmenu');
    }
	
	private function activate($label,&$array)
	{
		$sub=explode("/", $label,2);
		$array[$sub[0]]['active']=TRUE;
		if (isset($array[$sub[0]]['items'])) 
		{
			if (is_array($array[$sub[0]]['items'])) 
			{
				if ($sub[1]!='') 
				{
					$this->activate($sub[1],$array[$sub[0]]['items']);
				}	
			}
		}
		
	}
	
/*
 *  The following function is a modified version of the html_helper _list function
 * 
*/
	
	private function create( $attributes = '', $list)
	{
		if ( ! is_array($list))
		{
			return $list;
		}
		
		$out='';
		
		if (is_array($attributes))
		{
			$atts = '';
			foreach ($attributes as $key => $val)
			{
				$atts .= ' ' . $key . '="' . $val . '"';
			}
			$attributes = $atts;
		}
		elseif (is_string($attributes) AND strlen($attributes) > 0)
		{
			$attributes = ' '. $attributes;
		}

		$out .= "<ul".$attributes.">";
		
		$out .= $this->_list_recursive($list);

		$out .= "</ul>\n";

		return $out;
	}
	
	private function _list_recursive($list){
		$out='';
		foreach ($list as $item ) {
			if (isset($item["active"])) {
				$active = ($item["active"]==TRUE) ? TRUE : FALSE ;
			} else {
				$active = FALSE;
			}
			$out.='<li'.(($active)?' class="active"':'').'>';
			if (isset($item['url'],$item['label'])) {
				$out.='<a href="'.$item['url'].'"'.(($active)?' class="active"':'').'>'.$item["label"].'</a>';
			} elseif (isset($item['label'])) {
				$out.=$item['label'];
			}
			if (isset($item["items"])) {
				if (is_array($item["items"])) {
					$out.='<ul'.(($active)?' class="active"':'').'>'.$this->_list_recursive($item["items"]).'</ul>';
				}
			}
			$out.="</li>";
		}
		return $out;
	}
	

}


