<?php 
$app->get('/Barrios/:key', function () use ($app){
    $Barrios = \Barrio::all();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Barrios->toJson();

});

$app->get('/BarriosList/:comunidad_id/:key', function ($comunidad_id) use ($app){
    $municipios = \Barrio::where('comunidad_id' , '=', $comunidad_id)->get();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    if($municipios){
    echo $municipios->toJson();
	}else{
		echo json_encode(array());
	}

    

});


$app->get('/Barrios/:id/:key', function ($id) use ($app){
    $Barrios = \Barrio::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Barrios){
    echo $Barrios->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->post('/Barrios/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['Barrio'])){
	    $Barrios=new Barrio;
	    formatear($Barrios,$_POST['Barrio']);
		$Barrios->save();
		$app->response->setStatus(200);
    	echo $Barrios->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Barrios/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Barrios = \Barrio::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Barrios){
		if(isset($_REQUEST['Barrio'])){
	    formatear($Barrios,$_POST['Barrio']);
		$Barrios->save();
		$app->response->setStatus(200);
    	echo $Barrios->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});


$app->get('/BarriosDescripcion/:descripcion/:id/:key', function ($descripcion,$id) use ($app){
	$Barrios = \Barrio::where('descripcion' , '=', $descripcion)
									  ->where('id','!=',$id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Barrios){
    echo $Barrios->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->delete('/Barrios/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Barrios = \Barrio::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Barrios){
		$Barrios_old=$Barrios->toJson();
		$Barrios->delete();
		echo $Barrios_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>