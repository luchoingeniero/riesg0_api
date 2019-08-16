<?php 
$app->get('/Parentescos/:key', function () use ($app){
    $Parentescos = \Parentesco::all();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Parentescos->toJson();

});
$app->get('/Parentescos/:id/:key', function ($id) use ($app){
    $Parentescos = \Parentesco::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Parentescos){
    echo $Parentescos->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->post('/Parentescos/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['Parentesco'])){
	    $Parentescos=new Parentesco;
	    formatear($Parentescos,$_POST['Parentesco']);
		$Parentescos->save();
		$app->response->setStatus(200);
    	echo $Parentescos->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Parentescos/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Parentescos = \Parentesco::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Parentescos){
		if(isset($_REQUEST['Parentesco'])){
	    formatear($Parentescos,$_POST['Parentesco']);
		$Parentescos->save();
		$app->response->setStatus(200);
    	echo $Parentescos->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});


$app->get('/ParentescosDescripcion/:descripcion/:id/:key', function ($descripcion,$id) use ($app){
	$parentescos = \Parentesco::where('descripcion' , '=', $descripcion)
									  ->where('id','!=',$id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($parentescos){
    echo $parentescos->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->delete('/Parentescos/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $parentescos = \Parentesco::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($parentescos){
		$parentescos_old=$parentescos->toJson();
		$parentescos->delete();
		echo $parentescos_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>