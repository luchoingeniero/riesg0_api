<?php 
$app->get('/Escenarios/:key', function () use ($app){
    $Escenarios = \Escenario::all();
    foreach ($Escenarios as $key => $Escenario) {
    	$Escenario->comunidades;
    	$Escenarios[$key]=$Escenario;
    }
    //$Escenarios->comunidades;
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Escenarios->toJson();

});

$app->get('/Escenarios/:id/:key', function ($id) use ($app){
    $Escenarios = \Escenario::find($id);

    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Escenarios){
		$Escenarios->comunidades;
    echo $Escenarios->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->post('/Escenarios/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
   	if(isset($_POST['Escenario'])){
	    $Escenarios=new Escenario;
	    formatear($Escenarios,$_POST['Escenario']);
		$Escenarios->save();
		$Escenario_id=$Escenarios->id;
	
		/*if(isset($_POST['comunidades'])){		
		$comunidades=explode(',',$_POST['comunidades']);
		foreach ($comunidades as $key => $comunidad_id) {
			if($comunidad_id!='null'&&!empty($comunidad_id)){
			$comunidadEscenario=new \ComunidadEscenario;
			$comunidadEscenario->escenario_id=$Escenario_id;
			$comunidadEscenario->comunidad_id=$comunidad_id;
			$comunidadEscenario->save();
		}
	}
		}*/

		$Escenarios->comunidades;


		$app->response->setStatus(200);
    	echo $Escenarios->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Escenarios/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Escenarios = \Escenario::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Escenarios){
		if(isset($_REQUEST['Escenario'])){
	    formatear($Escenarios,$_POST['Escenario']);
		$Escenarios->save();
		$Escenario_id=$Escenarios->id;
		\ComunidadEscenario::where('Escenario_id',$Escenario_id)->delete();
		if($_POST['comunidades']!='null'){		
		$comunidades=explode(',',$_POST['comunidades']);
		foreach ($comunidades as $key => $comunidad_id) {
			if($comunidad_id!='null'&&!empty($comunidad_id)){
			$comunidadEscenario=new \ComunidadEscenario;
			$comunidadEscenario->escenario_id=$Escenario_id;
			$comunidadEscenario->comunidad_id=$comunidad_id;
			$comunidadEscenario->save();
		}
	}
	}

		$Escenarios->comunidades;

		$app->response->setStatus(200);
    	echo $Escenarios->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});


$app->get('/EscenariosDescripcion/:descripcion/:id/:key', function ($descripcion,$id) use ($app){
	$Escenarios = \Escenario::where('descripcion' , '=', $descripcion)
									  ->where('id','!=',$id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Escenarios){
    echo $Escenarios->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->delete('/Escenarios/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Escenarios = \Escenario::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Escenarios){
		$Escenarios_old=$Escenarios->toJson();
		$Escenarios->delete();
		echo $Escenarios_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>