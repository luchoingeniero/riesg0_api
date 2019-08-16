<?php 
$app->get('/ComunidadescenariosList/:comunidad_id/:key', function ($comunidad_id) use ($app){
    $Comunidadescenarios = \ComunidadEscenarios::where('comunidad_id',$comunidad_id)->get();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Comunidadescenarios->toJson();

});



$app->get('/Comunidadescenarios/:id/:key', function ($id) use ($app){
    $Comunidadescenarios = \ComunidadEscenarios::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Comunidadescenarios){
    echo $Comunidadescenarios->toJson();
	}else{
		echo json_encode(array());
	}

});



$app->post('/Comunidadescenarios/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['Comunidadescenarios'])){
	    $Comunidadescenarios=new ComunidadEscenarios;
	    formatear($Comunidadescenarios,$_POST['Comunidadescenarios']);
		$Comunidadescenarios->save();
		$app->response->setStatus(200);
    	echo $Comunidadescenarios->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Comunidadescenarios/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Comunidadescenarios = \ComunidadEscenarios::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Comunidadescenarios){
		if(isset($_REQUEST['Comunidadescenarios'])){
	    formatear($Comunidadescenarios,$_POST['Comunidadescenarios']);
		$Comunidadescenarios->save();
		$app->response->setStatus(200);
    	echo $Comunidadescenarios->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});



$app->delete('/Comunidadescenarios/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Comunidadescenarios = \ComunidadEscenarios::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Comunidadescenarios){
		$Comunidadescenarios_old=$Comunidadescenarios->toJson();
		$Comunidadescenarios->delete();
		echo $Comunidadescenarios_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>