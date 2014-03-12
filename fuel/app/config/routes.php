<?php
return array(
	'_root_'  => 'index/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
        'auth/activation_complete/(:any)' => array(array('GET', new \Fuel\Core\Route('auth/activation_complete/$1')))
);