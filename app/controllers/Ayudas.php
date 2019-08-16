<?php 

$app->get('/AyudasList/:afectacion_id/:key', function ($afectacion_id) use ($app){
	$ayudas = \Ayuda::where('afectacion_id' , '=', $afectacion_id)->get();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($ayudas){
    echo $ayudas->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->get('/Ayudas/:id/:key', function ($id) use ($app){
	$ayudas = \Ayuda::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($ayudas){
    echo $ayudas->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->post('/Ayudas/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['Ayuda'])){
	    $ayudas=new \Ayuda;
	    formatear($ayudas,$_POST['Ayuda']);
		$ayudas->save();
		$app->response->setStatus(200);
    	echo $ayudas->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Ayudas/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $ayudas = \Ayuda::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($ayudas){
		if(isset($_REQUEST['Ayuda'])){
		formatear($ayudas,$_POST['Ayuda']);
		$ayudas->save();
		$app->response->setStatus(200);
    	echo $ayudas->toJson();
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});



$app->delete('/Ayudas/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $ayudas = \Ayuda::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($ayudas){
		$ayudas_old=$ayudas->toJson();
		$ayudas->delete();
		echo $ayudas_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>