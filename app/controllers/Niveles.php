<?php 
$app->get('/Niveles/:key', function () use ($app){
    $Niveles = \Nivel::all();
    $callback=isset($_GET['callback'])?$_GET['callback'].'(':'';
    $cerrar_calback=(empty($callback))?'':');';	
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $callback.''.$Niveles->toJson().$cerrar_calback;

});
$app->get('/Niveles/:id/:key', function ($id) use ($app){
    $Niveles = \Nivel::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Niveles){
    echo $Niveles->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->post('/Niveles/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['Nivel'])){
	    $Niveles=new Nivel;
	    formatear($Niveles,$_POST['Nivel']);
		$Niveles->save();
		$app->response->setStatus(200);
    	echo $Niveles->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Niveles/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Niveles = \Nivel::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Niveles){
		if(isset($_REQUEST['Nivel'])){
	    formatear($Niveles,$_POST['Nivel']);
		$Niveles->save();
		$app->response->setStatus(200);
    	echo $Niveles->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});


$app->get('/NivelesDescripcion/:descripcion/:id/:key', function ($descripcion,$id) use ($app){
	$Niveles = \Nivel::where('descripcion' , '=', $descripcion)
									  ->where('id','!=',$id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Niveles){
    echo $Niveles->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->delete('/Niveles/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Niveles = \Nivel::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Niveles){
		$Niveles_old=$Niveles->toJson();
		$Niveles->delete();
		echo $Niveles_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>