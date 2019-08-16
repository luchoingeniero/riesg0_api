<?php 
$app->get('/Censos/:key', function () use ($app){
    $Censos = \Censo::all();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Censos->toJson();

});

$app->get('/CensosAtencion/:key', function () use ($app){
    $Censos = \Censo::where('tipocenso','ATENCION')->get();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Censos->toJson();

});

$app->get('/CensosPrevencion/:key', function () use ($app){
    $Censos = \Censo::where('tipocenso','PREVENCION')->get();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Censos->toJson();

});

$app->get('/CensosEscenarios/:escenario_id/:key', function ($escenario_id) use ($app){
    $Censos = \Censo::where('escenario_id',$escenario_id)->get();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Censos->toJson();

});

$app->get('/CensosHogares/:key', function () use ($app){
    $Censos = \CensoHogar::all();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Censos->toJson();

});


$app->get('/CensosActivos/:key', function () use ($app){
    $Censos = \Censo::where('estado','1')->get();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Censos->toJson();

});
$app->get('/Censos/:id/:key', function ($id) use ($app){
    $Censos = \Censo::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Censos){
    echo $Censos->toJson();
	}else{
		echo json_encode(array());
	}

});
$app->get('/CensosDescripcion/:codigo/:id/:key', function ($codigo,$id) use ($app){
	$censos = \Censo::where('codigo' , '=', $codigo)
									  ->where('id','!=',$id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($censos){
    echo $censos->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->post('/Censos/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['Censo'])){
	    $Censos=new Censo;
	    if(!isset($_POST['Censo']['tipocenso'])){
	    	$_POST['Censo']['tipocenso']='PREVENCION';
	    }
	    formatear($Censos,$_POST['Censo']);
		$Censos->save();
		$app->response->setStatus(200);
    	echo $Censos->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Censos/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Censos = \Censo::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Censos){
		if(isset($_REQUEST['Censo'])){
			
	    formatear($Censos,$_POST['Censo']);
		$Censos->save();
		$app->response->setStatus(200);
    	echo $Censos->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});



$app->delete('/Censos/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Censos = \Censo::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Censos){
		$Censos_old=$Censos->toJson();
		$Censos->delete();
		echo $Censos_old;
		
    }else{
		echo json_encode(array());
	}

	


});


$app->post('/CensosCerrar/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Censos = \Censo::find($id);
    $Censos->estado='INACTIVO';
	$Censos->save();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Censos){
		echo $Censos->toJson();
		
    }else{
		echo json_encode(array());
	}

	


});




?>