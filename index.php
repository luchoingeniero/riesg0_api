<?php 
use Illuminate\Database\Capsule\Manager as Capsule; 
require 'vendor/autoload.php';
$app = new \Slim\Slim();
$app->response->header('Access-Control-Allow-Origin', '*');
include('conexion.php');

/*Verificar que tiene Permiso */

$app->hook('slim.before.dispatch', function () use ($app){
	try{
	 $keyToCheck = $app->router()->getCurrentRoute()->getParam('key');
	}
	catch(Exception $e ){
		$keyToCheck=null;
	}
    //proceed with authentication methods
    //like call a class with methods to check valid keys in a database
    //and validate or not the access to data:
    //so, just a very, very simple example
    $authorized=($keyToCheck=='12345')?true:false;

    if(!$authorized){ //key is false
    	 $app->response()->setStatus(403);
    	
        $app->halt('403','{"error":{"text":"Lo Siento No tienes Permiso"}}'); // or redirect, or other something
    }
});



function formatear($obj,$arreglo){
    foreach ($arreglo as $key => $value) {
            $obj->$key=$value;
        }
}
function sendGoogleCloudMessage( $data, $ids )
{
   //$apiKey = 'AIzaSyD4F0mqHD-N32TuLYI2MMtEBoSySY7dItc';
   $apiKey='AIzaSyD4F0mqHD-N32TuLYI2MMtEBoSySY7dItc';
  $url = 'https://android.googleapis.com/gcm/send';
  $post = array(
                    'registration_ids'  => $ids,
                    'data'              => $data,
                    );

   $headers = array( 
                        'Authorization: key=' . $apiKey,
                        'Content-Type: application/json'
                    );
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $post ) );
    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $result=curl_exec( $ch );
    curl_close( $ch );
    /*
    if ( curl_errno( $ch ) )
    {
        echo 'GCM error: ' . curl_error( $ch );
    }
    
    echo $result;*/
}


/*
Carga de Todos los controladores
*/
$directorio = opendir("app/controllers");
while($elemento = readdir($directorio)){if($elemento != '.' && $elemento != '..'){include 'app/controllers/'.$elemento;}}


$app->run();
?>