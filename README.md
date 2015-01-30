# PHP-Bootstrap
PHP class for bootstrap rendering

Usage: 

<?php

// using composer & autoload

require 'vendor/autoload.php';

use \BT\Base;$load = new \BT\Base;

// using basic require call

//require_once("../src/BT/Base.php");

$c = new \BT\ContainerFluid(new \BT\Row(new \BT\ColMd6("col1"),new \BT\ColMd6("col2")));

\BT\Settings::$prettyPrint = false;

if($c->show() == '<div class="container-fluid"><div class="row"><div class="col-md-6">col1</div><div class="col-md-6">col2</div></div></div>'){

echo "Test ok\n";

}else{

echo "Test failed";

}
?>

Installation

Using composer:
1) Install composer 
curl -sS https://getcomposer.org/installer | php

2) Install composer package
php composer.phar require scholtz/bootstrap-php
