<?php 
$app->get('/CenhogescenariosList/:cen_hog_id/:key', function ($cen_hog_id) use ($app){
	$params=explode('_',$cen_hog_id);
	$censoHogar=\CensoHogar::where('censo_id',$params[0])->where('hogar_id',$params[1])->first();
    $Cenhogescenarios = \Cenhogescenarios::where('censo_hogar_id',$censoHogar->id)->get();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Cenhogescenarios->toJson();

});



$app->get('/Cenhogescenarios/:id/:key', function ($id) use ($app){
    $Cenhogescenarios = \Cenhogescenarios::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Cenhogescenarios){
    echo $Cenhogescenarios->toJson();
	}else{
		echo json_encode(array());
	}

});



$app->post('/Cenhogescenarios/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['Cenhogescenario'])){
	    $Cenhogescenarios=new Cenhogescenarios;
	    formatear($Cenhogescenarios,$_POST['Cenhogescenario']);
		$Cenhogescenarios->save();
		$app->response->setStatus(200);
    	echo $Cenhogescenarios->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Cenhogescenarios/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Cenhogescenarios = \Cenhogescenarios::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Cenhogescenarios){
		if(isset($_REQUEST['Cenhogescenario'])){
	    formatear($Cenhogescenarios,$_POST['Cenhogescenario']);
		$Cenhogescenarios->save();
		$app->response->setStatus(200);
    	echo $Cenhogescenarios->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});



$app->delete('/Cenhogescenarios/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Cenhogescenarios = \Cenhogescenarios::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Cenhogescenarios){
		$Cenhogescenarios_old=$Cenhogescenarios->toJson();
		$Cenhogescenarios->delete();
		echo $Cenhogescenarios_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>