<?php 
$app->get('/Comunidades/:key', function () use ($app){
    $Comunidades = \Comunidad::all();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Comunidades->toJson();

});

$app->get('/ComunidadesList/:municipio_id/:key', function ($municipio_id) use ($app){
    $municipios = \Comunidad::where('municipio_id' , '=', $municipio_id)->get();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    if($municipios){
    echo $municipios->toJson();
	}else{
		echo json_encode(array());
	}

    

});


$app->get('/Comunidades/:id/:key', function ($id) use ($app){
    $Comunidades = \Comunidad::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Comunidades){
    echo $Comunidades->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->post('/Comunidades/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['Comunidad'])){
	    $Comunidades=new Comunidad;
	    formatear($Comunidades,$_POST['Comunidad']);
		$Comunidades->save();
		$app->response->setStatus(200);
    	echo $Comunidades->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Comunidades/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Comunidades = \Comunidad::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Comunidades){
		if(isset($_REQUEST['Comunidad'])){
	    formatear($Comunidades,$_POST['Comunidad']);
		$Comunidades->save();
		$app->response->setStatus(200);
    	echo $Comunidades->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});


$app->get('/ComunidadesDescripcion/:descripcion/:id/:key', function ($descripcion,$id) use ($app){
	$Comunidades = \Comunidad::where('descripcion' , '=', $descripcion)
									  ->where('id','!=',$id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Comunidades){
    echo $Comunidades->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->delete('/Comunidades/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Comunidades = \Comunidad::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Comunidades){
		$Comunidades_old=$Comunidades->toJson();
		$Comunidades->delete();
		echo $Comunidades_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>