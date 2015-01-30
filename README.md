# PHP-Bootstrap
PHP class for bootstrap rendering

Usage: 

<?php
use \BT\Base;

$c = new \BT\ContainerFluid(new \BT\Row(new \BT\ColMd6("col1"),new \BT\ColMd6("col2")));
echo $c->show();

?>

Installation

Using composer:
1) Install composer 
curl -sS https://getcomposer.org/installer | php

2) Install composer package
php ~/composer.phar require scholtz/bootstrap-php
