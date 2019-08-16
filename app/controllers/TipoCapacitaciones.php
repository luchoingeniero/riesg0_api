<?php 
$app->get('/TipoCapacitaciones/:key', function () use ($app){
    $TipoCapacitacion = \TipoCapacitacion::all();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $TipoCapacitacion->toJson();

});



$app->get('/TipoCapacitaciones/:id/:key', function ($id) use ($app){
    $TipoCapacitacion = \TipoCapacitacion::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($TipoCapacitacion){
    echo $TipoCapacitacion->toJson();
	}else{
		echo json_encode(array());
	}

});



$app->post('/TipoCapacitaciones/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['TipoCapacitacion'])){
	    $TipoCapacitacion=new TipoCapacitacion;
	    formatear($TipoCapacitacion,$_POST['TipoCapacitacion']);
		$TipoCapacitacion->save();
		$app->response->setStatus(200);
    	echo $TipoCapacitacion->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/TipoCapacitaciones/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $TipoCapacitacion = \TipoCapacitacion::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($TipoCapacitacion){
		if(isset($_REQUEST['TipoCapacitacion'])){
	    formatear($TipoCapacitacion,$_POST['TipoCapacitacion']);
		$TipoCapacitacion->save();
		$app->response->setStatus(200);
    	echo $TipoCapacitacion->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});

$app->get('/TipoCapacitacionesDescripcion/:descripcion/:id/:key', function ($descripcion,$id) use ($app){
	$TipoCapacitacion = \TipoCapacitacion::where('descripcion' , '=', $descripcion)
									  ->where('id','!=',$id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($TipoCapacitacion){
    echo $TipoCapacitacion->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->delete('/TipoCapacitaciones/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $TipoCapacitacion = \TipoCapacitacion::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($TipoCapacitacion){
		$TipoCapacitacion_old=$TipoCapacitacion->toJson();
		$TipoCapacitacion->delete();
		echo $TipoCapacitacion_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>