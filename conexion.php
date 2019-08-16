<?php 
use Illuminate\Database\Capsule\Manager as Capsule;  

$app->db= new Capsule; 

$app->db->addConnection(array(
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'riesg0',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => ''
));
$app->db->setAsGlobal();
$app->db->bootEloquent();