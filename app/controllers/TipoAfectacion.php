<?php 
$app->get('/TipoAfectaciones/:key', function () use ($app){
    $TipoAfectaciones = \TipoAfectacion::all();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $TipoAfectaciones->toJson();

});



$app->get('/TipoAfectaciones/:id/:key', function ($id) use ($app){
    $TipoAfectaciones = \TipoAfectacion::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($TipoAfectaciones){
    echo $TipoAfectaciones->toJson();
	}else{
		echo json_encode(array());
	}

});



$app->post('/TipoAfectaciones/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['TipoAfectacion'])){
	    $TipoAfectaciones=new TipoAfectacion;
	    formatear($TipoAfectaciones,$_POST['TipoAfectacion']);
		$TipoAfectaciones->save();
		$app->response->setStatus(200);
    	echo $TipoAfectaciones->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/TipoAfectaciones/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $TipoAfectaciones = \TipoAfectacion::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($TipoAfectaciones){
		if(isset($_REQUEST['TipoAfectacion'])){
	    formatear($TipoAfectaciones,$_POST['TipoAfectacion']);
		$TipoAfectaciones->save();
		$app->response->setStatus(200);
    	echo $TipoAfectaciones->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});

$app->get('/TipoAfectacionesDescripcion/:descripcion/:id/:key', function ($descripcion,$id) use ($app){
	$TipoAfectaciones = \TipoAfectacion::where('descripcion' , '=', $descripcion)
									  ->where('id','!=',$id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($TipoAfectaciones){
    echo $TipoAfectaciones->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->delete('/TipoAfectaciones/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $TipoAfectaciones = \TipoAfectacion::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($TipoAfectaciones){
		$TipoAfectaciones_old=$TipoAfectaciones->toJson();
		$TipoAfectaciones->delete();
		echo $TipoAfectaciones_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>