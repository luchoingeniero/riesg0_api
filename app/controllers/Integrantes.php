<?php 
$app->get('/Integrantes/:key', function () use ($app){
    $Integrantes = \Integranteshogar::all();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Integrantes->toJson();

});
$app->get('/Integrantes/:id/:key', function ($id) use ($app){
    $Integrantes = \Integranteshogar::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Integrantes){
    echo $Integrantes->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->get('/IntegrantesList/:hogar_id/:key', function ($hogar_id) use ($app){
    $Integrantes = \Integranteshogar::where('hogar_id' , '=', $hogar_id)->get();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Integrantes){
    echo $Integrantes->toJson();
	}else{
		echo json_encode(array());
	}

});


$app->post('/Integrantes/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['Integrante'])){
	    $Integrantes=new Integranteshogar;
	    formatear($Integrantes,$_POST['Integrante']);
		$Integrantes->save();
		$app->response->setStatus(200);
    	echo $Integrantes->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Integrantes/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Integrantes = \Integranteshogar::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Integrantes){
		if(isset($_REQUEST['Integrante'])){
	    formatear($Integrantes,$_POST['Integrante']);
		$Integrantes->save();
		$app->response->setStatus(200);
    	echo $Integrantes->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});



$app->delete('/Integrantes/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Integrantes = \Integranteshogar::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Integrantes){
		$Integrantes_old=$Integrantes->toJson();
		$Integrantes->delete();
		echo $Integrantes_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>