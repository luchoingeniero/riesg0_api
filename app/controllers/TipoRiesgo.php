<?php 
$app->get('/TipoRiesgos/:key', function () use ($app){
    $TipoRiesgos = \TipoRiesgo::all();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $TipoRiesgos->toJson();

});



$app->get('/TipoRiesgos/:id/:key', function ($id) use ($app){
    $TipoRiesgos = \TipoRiesgo::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($TipoRiesgos){
    echo $TipoRiesgos->toJson();
	}else{
		echo json_encode(array());
	}

});



$app->post('/TipoRiesgos/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['TipoRiesgo'])){
	    $TipoRiesgos=new TipoRiesgo;
	    formatear($TipoRiesgos,$_POST['TipoRiesgo']);
		$TipoRiesgos->save();
		$app->response->setStatus(200);
    	echo $TipoRiesgos->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/TipoRiesgos/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $TipoRiesgos = \TipoRiesgo::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($TipoRiesgos){
		if(isset($_REQUEST['TipoRiesgo'])){
	    formatear($TipoRiesgos,$_POST['TipoRiesgo']);
		$TipoRiesgos->save();
		$app->response->setStatus(200);
    	echo $TipoRiesgos->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});

$app->get('/TipoRiesgosDescripcion/:descripcion/:id/:key', function ($descripcion,$id) use ($app){
	$TipoRiesgos = \TipoRiesgo::where('descripcion' , '=', $descripcion)
									  ->where('id','!=',$id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($TipoRiesgos){
    echo $TipoRiesgos->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->delete('/TipoRiesgos/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $TipoRiesgos = \TipoRiesgo::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($TipoRiesgos){
		$TipoRiesgos_old=$TipoRiesgos->toJson();
		$TipoRiesgos->delete();
		echo $TipoRiesgos_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>