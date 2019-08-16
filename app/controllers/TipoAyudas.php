<?php 
$app->get('/TipoAyudas/:key', function () use ($app){
    $TipoAyudas = \TipoAyuda::all();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $TipoAyudas->toJson();

});



$app->get('/TipoAyudas/:id/:key', function ($id) use ($app){
    $TipoAyudas = \TipoAyuda::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($TipoAyudas){
    echo $TipoAyudas->toJson();
	}else{
		echo json_encode(array());
	}

});



$app->post('/TipoAyudas/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['TipoAyuda'])){
	    $TipoAyudas=new TipoAyuda;
	    formatear($TipoAyudas,$_POST['TipoAyuda']);
		$TipoAyudas->save();
		$app->response->setStatus(200);
    	echo $TipoAyudas->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/TipoAyudas/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $TipoAyudas = \TipoAyuda::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($TipoAyudas){
		if(isset($_REQUEST['TipoAyuda'])){
	    formatear($TipoAyudas,$_POST['TipoAyuda']);
		$TipoAyudas->save();
		$app->response->setStatus(200);
    	echo $TipoAyudas->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});

$app->get('/TipoAyudasDescripcion/:descripcion/:id/:key', function ($descripcion,$id) use ($app){
	$TipoAyudas = \TipoAyuda::where('descripcion' , '=', $descripcion)
									  ->where('id','!=',$id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($TipoAyudas){
    echo $TipoAyudas->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->delete('/TipoAyudas/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $TipoAyudas = \TipoAyuda::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($TipoAyudas){
		$TipoAyudas_old=$TipoAyudas->toJson();
		$TipoAyudas->delete();
		echo $TipoAyudas_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>