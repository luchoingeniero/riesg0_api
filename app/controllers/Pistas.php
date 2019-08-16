<?php 
$app->get('/Pistas/:key', function () use ($app){
    $Pistas = \Pista::all();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Pistas->toJson();

});
$app->get('/Pistas/:id/:key', function ($id) use ($app){
    $Pistas = \Pista::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Pistas){
    echo $Pistas->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->post('/Pistas/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['Pista'])){
	    $Pistas=new Pista;
	    formatear($Pistas,$_POST['Pista']);
		$Pistas->save();
		$app->response->setStatus(200);
    	echo $Pistas->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Pistas/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Pistas = \Pista::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Pistas){
		if(isset($_REQUEST['Pista'])){
	    formatear($Pistas,$_POST['Pista']);
		$Pistas->save();
		$app->response->setStatus(200);
    	echo $Pistas->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});


$app->get('/PistasDescripcion/:descripcion/:id/:key', function ($descripcion,$id) use ($app){
	$Pistas = \Pista::where('descripcion' , '=', $descripcion)
									  ->where('id','!=',$id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Pistas){
    echo $Pistas->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->delete('/Pistas/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Pistas = \Pista::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Pistas){
		$Pistas_old=$Pistas->toJson();
		$Pistas->delete();
		echo $Pistas_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>