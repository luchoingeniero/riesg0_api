<?php 

$app->get('/TemasList/:programa_id/:key', function ($programa_id) use ($app){
	$programa= \Programa::find($programa_id);
    $Temas=$programa->temas;
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Temas){
    echo $Temas->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->get('/Temas/:tema_id/:key', function ($tema_id) use ($app){
	
	$Temas=\Tema::find($tema_id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Temas){
    echo $Temas->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->post('/Temas/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['Tema'])){
	    $Temas=new \Tema;
	    formatear($Temas,$_POST['Tema']);
		$Temas->save();
		$app->response->setStatus(200);
    	echo $Temas->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Temas/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Temas = \Tema::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Temas){
		if(isset($_REQUEST['Tema'])){
		formatear($Temas,$_POST['Tema']);
		$Temas->save();
		$app->response->setStatus(200);
    	echo $Temas->toJson();
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});

/*$app->get('/TemasDescripcion/:descripcion/:id/:key', function ($descripcion,$id) use ($app){

	$programa=\Tema::find($id);
	$programa_id=($programa)?$programa->programa_id:-1;
	$temas = \Tema::where('descripcion' , '=', $descripcion)
				  ->where('id','!=',$id)
				  ->where('programa_id',$programa_id)
				  ->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($temas){
    echo $temas->toJson();
	}else{
		echo json_encode(array());
	}

});
*/
$app->delete('/Temas/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Temas = \Tema::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Temas){
		$Temas_old=$Temas->toJson();
		$Temas->delete();
		echo $Temas_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>