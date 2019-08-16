<?php 
$app->get('/Hogares/:key', function () use ($app){
    $Hogares = \Hogar::all();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Hogares->toJson();

});
$app->get('/Hogares/:id/:key', function ($id) use ($app){
    $Hogares = \Hogar::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Hogares){
    echo $Hogares->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->get('/HogaresCenso/:censo_id/:hogar_id/:key', function ($censo_id,$hogar_id) use ($app){
    $Hogares_ = \CensoHogar::where('censo_id',$censo_id)->where('hogar_id',$hogar_id)->first();
    $Hogares = \Hogar::find($hogar_id);
    $Hogares->nivelriesgo=$Hogares_->nivelriesgo;
     $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Hogares){
    echo $Hogares->toJson();
	}else{
		echo json_encode(array());
	}

});



$app->get('/HogaresCodigo/:codigo/:key', function ($codigo) use ($app){
    $Hogares = \Hogar::where('codigo','=',$codigo)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Hogares){
    echo $Hogares->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->get('/HogaresList/:censo_id/:key', function ($censo_id) use ($app){
    $Censo = \Censo::find($censo_id);
    $Hogares=$Censo->hogares;
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Hogares){
    echo $Hogares->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->get('/HogaresDescripcion/:codigo/:id/:key', function ($codigo,$id) use ($app){
	$hogares = \Hogar::where('codigo' , '=', $codigo)
									  ->where('id','!=',$id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($hogares){
    echo $hogares->toJson();
	}else{
		echo json_encode(array());
	}

});


$app->post('/Hogares/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['Hogar'])){
	    $Hogares=new Hogar;
	    formatear($Hogares,$_POST['Hogar']);
		$Hogares->save();
		$censo_id=$_POST['censo_id'];
		
		$existe=\CensoHogar::where('hogar_id','=',$Hogares->id)
							 ->where('censo_id','=',$censo_id)->first();

		if(!$existe){
			$censohogar=new \CensoHogar;
			$censohogar->hogar_id=$Hogares->id;
			$censohogar->censo_id=$censo_id;
			
			$censohogar->save();

			$obj_censo=\Censo::find($censo_id);
			$obj_escenarios=\ComunidadEscenarios::where('comunidad_id',$obj_censo->comunidad_id)->get();
			
			foreach ($obj_escenarios as $key => $conf_escenarios) {
				$cenhogesce=new \Cenhogescenarios();
				$cenhogesce->censo_hogar_id=$censohogar->id;
				$cenhogesce->escenario_id=$conf_escenarios->escenario_id;
				$cenhogesce->save();

			}


		}					 

		$app->response->setStatus(200);
    	echo $Hogares->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Hogares/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Hogares = \Hogar::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Hogares){
		if(isset($_REQUEST['Hogar'])){
	    formatear($Hogares,$_POST['Hogar']);
		$Hogares->save();
		$censo_id=$_POST['censo_id'];
		
		$existe=\CensoHogar::where('hogar_id','=',$Hogares->id)
							 ->where('censo_id','=',$censo_id)->first();

		if(!$existe){
			$censohogar=new \CensoHogar;
			$censohogar->hogar_id=$Hogares->id;
			$censohogar->censo_id=$censo_id;
			
			$censohogar->save();

			$obj_censo=\Censo::find($censo_id);
			$obj_escenarios=\ComunidadEscenarios::where('comunidad_id',$obj_censo->comunidad_id)->get();
			foreach ($obj_escenarios as $key => $conf_escenarios) {
				$cenhogesce=new \Cenhogescenarios();
				$cenhogesce->censo_hogar_id=$censohogar->id;
				$cenhogesce->escenario_id=$conf_escenarios->escenario_id;
				$cenhogesce->save();

			}

		}else{
		
		$existe->save();
	}
		$app->response->setStatus(200);
    	echo $Hogares->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});



$app->delete('/Hogares/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $params=explode('_', $id);
    $Hogares = \CensoHogar::where('censo_id',$params[0])->where('hogar_id',$params[1])->first();
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Hogares){
		$Hogares_old=$Hogares->toJson();
		$Hogares->delete();
		echo $Hogares_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>