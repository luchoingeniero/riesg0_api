<?php 


$app->get('/CapacitacionesList/:pac_id/:key', function ($pac_id) use ($app){
	$pac= \Pac::find($pac_id);
    $capacitaciones=$pac->capacitaciones;
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($capacitaciones){
    echo $capacitaciones->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->get('/Capacitaciones/:id/:key', function ($id) use ($app){
    $Capacitaciones = \Capacitacion::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Capacitaciones){
    echo $Capacitaciones->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->post('/Capacitaciones/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['Capacitacion'])){
	    $Capacitaciones=new Capacitacion;
	    formatear($Capacitaciones,$_POST['Capacitacion']);
		$Capacitaciones->save();
		$app->response->setStatus(200);
    	echo $Capacitaciones->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Capacitaciones/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Capacitaciones = \Capacitacion::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Capacitaciones){
		if(isset($_REQUEST['Capacitacion'])){
	    formatear($Capacitaciones,$_POST['Capacitacion']);
		$Capacitaciones->save();
		$app->response->setStatus(200);
    	echo $Capacitaciones->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});


$app->get('/CapacitacionesDescripcion/:descripcion/:id/:key', function ($descripcion,$id) use ($app){
	$Capacitaciones = \Capacitacion::where('descripcion' , '=', $descripcion)
									  ->where('id','!=',$id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Capacitaciones){
    echo $Capacitaciones->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->delete('/Capacitaciones/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Capacitaciones = \Capacitacion::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Capacitaciones){
		$Capacitaciones_old=$Capacitaciones->toJson();
		$Capacitaciones->delete();
		echo $Capacitaciones_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>