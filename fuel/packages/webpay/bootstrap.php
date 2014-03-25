<?php
Autoloader::add_core_namespace('MyWebpay');

Autoloader::add_classes(array(
	
	'MyWebpay\\Webpay'							=> __DIR__.'/classes/webpay.php',
    ));