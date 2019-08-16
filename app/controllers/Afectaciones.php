<?php 

$app->get('/AfectacionesList/:censohogar_id/:key', function ($censohogar_id) use ($app){
	$campos=explode('_',$censohogar_id);
	$Censo = \CensoHogar::where('censo_id',$campos[0])
						  ->where('hogar_id',$campos[1])->first();
    $Afectaciones=$Censo->Afectaciones;
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Afectaciones){
    echo $Afectaciones->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->get('/Afectaciones/:id/:key', function ($id) use ($app){
	 $Afectaciones=\Afectacion::find($id);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Afectaciones){
    echo $Afectaciones->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->post('/Afectaciones/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['Afectacion'])){
	    $Afectaciones=new \Afectacion;
	    $censohogar_id=$_POST['Afectacion']['censo_hogar_id'];
	    $campos=explode('_',$censohogar_id);
	    if(count($campos)>1){
		$Censo = \CensoHogar::where('censo_id',$campos[0])
						  ->where('hogar_id',$campos[1])->first();

		$_POST['Afectacion']['censo_hogar_id']=$Censo->id;
		}						  
	    formatear($Afectaciones,$_POST['Afectacion']);
		$Afectaciones->save();
		$app->response->setStatus(200);
    	echo $Afectaciones->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Afectaciones/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Afectaciones = \Afectacion::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Afectaciones){
		if(isset($_REQUEST['Afectacion'])){
		formatear($Afectaciones,$_POST['Afectacion']);
		$Afectaciones->save();
		$app->response->setStatus(200);
    	echo $Afectaciones->toJson();
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});



$app->delete('/Afectaciones/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Afectaciones = \Afectacion::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Afectaciones){
		$Afectaciones_old=$Afectaciones->toJson();
		$Afectaciones->delete();
		echo $Afectaciones_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>