<?php 
$app->get('/Lideres/:key', function () use ($app){
    $Lideres = \Lider::all();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Lideres->toJson();

});

$app->get('/LideresList/:comunidad_id/:key', function ($comunidad_id) use ($app){
    $municipios = \Lider::where('comunidad_id' , '=', $comunidad_id)->get();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    if($municipios){
    echo $municipios->toJson();
	}else{
		echo json_encode(array());
	}

    

});


$app->get('/Lideres/:id/:key', function ($id) use ($app){
    $Lideres = \Lider::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Lideres){
    echo $Lideres->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->post('/Lideres/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['Lider'])){
	    $Lideres=new Lider;
	    formatear($Lideres,$_POST['Lider']);
		$Lideres->save();
		$app->response->setStatus(200);
    	echo $Lideres->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Lideres/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Lideres = \Lider::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Lideres){
		if(isset($_REQUEST['Lider'])){
	    formatear($Lideres,$_POST['Lider']);
		$Lideres->save();
		$app->response->setStatus(200);
    	echo $Lideres->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});


$app->get('/LideresDescripcion/:descripcion/:id/:key', function ($descripcion,$id) use ($app){
	$Lideres = \Lider::where('descripcion' , '=', $descripcion)
									  ->where('id','!=',$id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Lideres){
    echo $Lideres->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->delete('/Lideres/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Lideres = \Lider::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Lideres){
		$Lideres_old=$Lideres->toJson();
		$Lideres->delete();
		echo $Lideres_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>