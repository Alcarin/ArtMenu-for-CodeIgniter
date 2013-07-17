ArtMenu-for-CodeIgniter
=======================

Artisteer 4 Menu Library for CodeIngiter allow to create ul tag utilized by artisteer to print the horizontal and vertical menus, simply declaring an array.
Feature list:

* Create a menu structure simply declaring an array
* Create shared menu, declaring the menu array in a config file
* Modify the shared menu "on the fly" before render it
* Utilize a string to specify wich item in the menu must be rendered as "active/selected" 
* Manage infinite submenus

##Installation

* copy application/libraries/art_menu.php in your application/libraries/  folder
* copy application/config/art_menu.php in your application/config  folder
* modify your application/config/art_menu.php to adapt to your website menu

application/controller/page.php contain controller usage examples.

##Usage Example

Use the application/config/art_menu.php to describe your website standard menus (the ones that should be showed in the major port of your website). For example:

    $config['hmenu']= array(
 		'home' => array('label' => 'Home', 'url' => '/', 'items' => array(
 			'subpage1' => array('label' => 'Subpage 1', 'url' => '/page/sub1'),
 			'subpage2' => array('label' => 'Subpage 2', 'url' => '/page/sub2'),
 			'subpage3' => array('label' => 'Subpage 3', 'url' => '/page/sub3'))),
 		'login' => array('label' => 'Login', 'url' => '/user/login' ),
  		'credits' => array('label' => 'Credits', 'url' => '/page/credits' )					
 	);
 					
In a controller you must load the library, render the menu and send the rendered menu to a view:

    $this->load->library('art_menu');
  	$data['hmenu']=$this->art_menu->rendermenu('hmenu');
  	$this->load->view('page',$data);

In a view you need only to echo the rendered menu:

    <?=$hmenu?>
 

Perform the previous steps for hmenu (horizontal menu) and/or vmenu (vertical menu).

##Advanced Features

###Making an item rendered as selected
Array items, other than label, url and items (submenus) support the index "active" that if is TRUE let the menu item rendered as active/selected.
To let an item be rendered as active you only need to let the corresponding menu item have the "active" index set to TRUE, and you can do that in those ways:

1. Most of the times you can simple pass a string to the rendermenu function describing the voice that you want to be activated

    $data['hmenu']=$this->art_menu->rendermenu('hmenu','home/subpage1');

the string is composed by array indexes name and a '/' is used to separate primary item from their submenu items. 
In the previous example, subpage1 item that is a child of home item, will be rendered as active.

2. If you want to manually set an item as active, or you need to activate more than one item, you should manually modify the array:

    $this->art_menu->hmenu["home"]["active"]=TRUE;

Take note that for certain menu, to properly activate a submenu item you should also activate the parent menu item, as done in the following example:

    $this->art_menu->hmenu["home"]["items"]["subpage1"]["active"]=TRUE;
    $this->art_menu->hmenu["home"]["active"]=TRUE;

3. If you want to render active a voice _by_ _default_, you can modify the config file declaring in the corrispondant menu item "active" as TRUE

    $config['hmenu']= array(
 		'home' => array('label' => 'Home', 'url' => '/', 'active' => TRUE),
 		'login' => array('label' => 'Login', 'url' => '/user/login' ),
  		'credits' => array('label' => 'Credits', 'url' => '/page/credits' )					
 	);
 			
###Dinamically modify the menu
If you want to add, modify a menu item (only for certain page or only in certain condition), or completly override the menu, you can modify the public menu array after loaded the library and before rendering the menu 

    $this->load->library('art_menu');

after loaded the library, we can for example modify the login menu item with logout functionality:

    $this->art_menu->hmenu['login']['label']='Logout';
    $this->art_menu->hmenu['login']['url']='/user/logout';

or we can add another menu item if an user is authenticated

    $this->art_menu->hmenu['admin']=array('label' => 'Admin', 'url' => '/page/admin');
    
or we can completly override the menu configured in the config file 

    $this->art_menu->vmenu=array(
 		'home' => array('label' => 'Home', 'url' => '/', 'items' => array(
 			'subpage1' => array('label' => 'Subpage 1', 'url' => '/page/sub1','items'=>array(
 				'login' => array('label' => 'Login', 'url' => '/user/login' ),
  				'credits' => array('label' => 'Credits', 'url' => '/page/credits', 'items'=>array(
  					'login' => array('label' => 'Login', 'url' => '/user/login' ),
  					'credits' => array('label' => 'Credits', 'url' => '/page/credits' )	))	)),
 			'subpage2' => array('label' => 'Subpage 2', 'url' => '/page/sub2'),
 			'subpage3' => array('label' => 'Subpage 3', 'url' => '/page/sub3'))),
 		'login' => array('label' => 'Login', 'url' => '/user/login' ),
  		'credits' => array('label' => 'Credits', 'url' => '/page/credits' )					
 		);
 					
after we have modified the menu, we can render it and send the result to a view (in the followin code we are rendering bot horizontal and vertical menu)

  	$data['hmenu']=$this->art_menu->rendermenu('hmenu');
  	$data['vmenu']=$this->art_menu->rendermenu('vmenu');
  	$this->load->view('header',$data);
  	$this->load->view('column1',$data);
  	
