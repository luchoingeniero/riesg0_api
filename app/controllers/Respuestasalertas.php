<?php 
$app->get('/Respuestasalertas/:key', function () use ($app){
    $Respuestasalertas = \Respuestasalerta::all();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Respuestasalertas->toJson();

});
$app->get('/Respuestasalertas/:id/:key', function ($id) use ($app){
    $Respuestasalertas = \Respuestasalerta::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Respuestasalertas){
    echo $Respuestasalertas->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->post('/Respuestasalertas/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['Respuestasalerta'])){
	    $Respuestasalertas=new Respuestasalerta;
	    formatear($Respuestasalertas,$_POST['Respuestasalerta']);
		$Respuestasalertas->save();
		$app->response->setStatus(200);
    	echo $Respuestasalertas->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Respuestasalertas/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Respuestasalertas = \Respuestasalerta::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Respuestasalertas){
		if(isset($_REQUEST['Respuestasalerta'])){
	    formatear($Respuestasalertas,$_POST['Respuestasalerta']);
		$Respuestasalertas->save();
		$app->response->setStatus(200);
    	echo $Respuestasalertas->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});


$app->get('/RespuestasalertasDescripcion/:descripcion/:id/:key', function ($descripcion,$id) use ($app){
	$Respuestasalertas = \Respuestasalerta::where('descripcion' , '=', $descripcion)
									  ->where('id','!=',$id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Respuestasalertas){
    echo $Respuestasalertas->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->delete('/Respuestasalertas/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Respuestasalertas = \Respuestasalerta::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Respuestasalertas){
		$Respuestasalertas_old=$Respuestasalertas->toJson();
		$Respuestasalertas->delete();
		echo $Respuestasalertas_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>