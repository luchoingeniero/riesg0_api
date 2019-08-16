<?php 
$app->get('/Invitados/:key', function () use ($app){
    $Invitados = \Invitado::all();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Invitados->toJson();

});
$app->get('/Invitados/:id/:key', function ($id) use ($app){
    $Invitados = \Invitado::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Invitados){
    echo $Invitados->toJson();
	}else{
		echo json_encode(array());
	}

});
$app->get('/InvitadosDescripcion/:codigo/:id/:key', function ($codigo,$id) use ($app){
	$Invitados = \Invitado::where('codigo' , '=', $codigo)
									  ->where('id','!=',$id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Invitados){
    echo $Invitados->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->post('/Invitados/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['Invitado'])){
	    $Invitados=new Invitado;
	    formatear($Invitados,$_POST['Invitado']);
		$Invitados->save();
		
		$foto=$_POST['foto'];
		if(!empty($foto)){
  		file_put_contents("../riesg0/archivos/invitados/".$Invitados->id.'.jpg', base64_decode($foto));
  		}

		$app->response->setStatus(200);
    	echo $Invitados->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Invitados/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Invitados = \Invitado::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Invitados){
		if(isset($_REQUEST['Invitado'])){
	    formatear($Invitados,$_POST['Invitado']);
		$Invitados->save();
		$foto=$_POST['foto'];
		if(!empty($foto)){
  		file_put_contents("../riesg0/archivos/invitados/".$Invitados->id.'.jpg', base64_decode($foto));
  		}
		$app->response->setStatus(200);
    	echo $Invitados->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});



$app->delete('/Invitados/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Invitados = \Invitado::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Invitados){
		$Invitados_old=$Invitados->toJson();
		$Invitados->delete();
		echo $Invitados_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>