# PHP-Bootstrap
PHP class for bootstrap rendering

Usage: 
<?php

$c = new \BT\ContainerFluid(new \BT\Row(new \BT\ColMd6("col1"),new \BT\ColMd6("col2")));
echo $c->show();
