<?php 
$app->get('/Pacs/:key', function () use ($app){
    $Pacs = \Pac::all();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Pacs->toJson();

});
$app->get('/Pacs/:id/:key', function ($id) use ($app){
    $Pacs = \Pac::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Pacs){
    echo $Pacs->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->post('/Pacs/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['Pac'])){
	    $Pacs=new Pac;
	    formatear($Pacs,$_POST['Pac']);
		$Pacs->save();
		$app->response->setStatus(200);
    	echo $Pacs->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Pacs/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Pacs = \Pac::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Pacs){
		if(isset($_REQUEST['Pac'])){
	    formatear($Pacs,$_POST['Pac']);
		$Pacs->save();
		$app->response->setStatus(200);
    	echo $Pacs->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});


$app->get('/PacsDescripcion/:descripcion/:id/:key', function ($descripcion,$id) use ($app){
	$Pacs = \Pac::where('descripcion' , '=', $descripcion)
									  ->where('id','!=',$id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Pacs){
    echo $Pacs->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->delete('/Pacs/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Pacs = \Pac::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Pacs){
		$Pacs_old=$Pacs->toJson();
		$Pacs->delete();
		echo $Pacs_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>