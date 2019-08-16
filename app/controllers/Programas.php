<?php 
$app->get('/Programas/:key', function () use ($app){
    $Programas = \Programa::all();
    foreach ($Programas as $key => $Programa) {
    	$Programa->pistas;
    	$Programas[$key]=$Programa;
    }
    //$Programas->pistas;
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Programas->toJson();

});
$app->get('/Programas/:id/:key', function ($id) use ($app){
    $Programas = \Programa::find($id);

    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Programas){
		$Programas->pistas;
    echo $Programas->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->post('/Programas/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
   	if(isset($_POST['Programa'])){
	    $Programas=new Programa;
	    formatear($Programas,$_POST['Programa']);
		$Programas->save();
		$programa_id=$Programas->id;
	
		if(isset($_POST['pistas'])){		
		$pistas=explode(',',$_POST['pistas']);
		foreach ($pistas as $key => $pista_id) {
			if($pista_id!='null'&&!empty($pista_id)){
			$pistaprograma=new \PistaPrograma;
			$pistaprograma->programa_id=$programa_id;
			$pistaprograma->pista_id=$pista_id;
			$pistaprograma->save();
		}
	}
		}

		$Programas->pistas;


		$app->response->setStatus(200);
    	echo $Programas->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Programas/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Programas = \Programa::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Programas){
		if(isset($_REQUEST['Programa'])){
	    formatear($Programas,$_POST['Programa']);
		$Programas->save();
		$programa_id=$Programas->id;
		\PistaPrograma::where('programa_id',$programa_id)->delete();
		if($_POST['pistas']!='null'){		
		$pistas=explode(',',$_POST['pistas']);
		foreach ($pistas as $key => $pista_id) {
			if($pista_id!='null'&&!empty($pista_id)){
			$pistaprograma=new \PistaPrograma;
			$pistaprograma->programa_id=$programa_id;
			$pistaprograma->pista_id=$pista_id;
			$pistaprograma->save();
		}
	}
	}

		$Programas->pistas;

		$app->response->setStatus(200);
    	echo $Programas->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});


$app->get('/ProgramasDescripcion/:descripcion/:id/:key', function ($descripcion,$id) use ($app){
	$Programas = \Programa::where('descripcion' , '=', $descripcion)
									  ->where('id','!=',$id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Programas){
    echo $Programas->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->delete('/Programas/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Programas = \Programa::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Programas){
		$Programas_old=$Programas->toJson();
		$Programas->delete();
		echo $Programas_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>