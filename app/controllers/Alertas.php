<?php 
$app->get('/Alertas/:key', function () use ($app){

    $Alertas = \Alerta::all();
    foreach ($Alertas as $key => $alerta) {
    	$alerta->invitado;
    	$alerta->categoria;
    	$alerta->nivel;
        $alerta->user;
    	$alerta->foto=file_exists('../riesg0/archivos/alertas/'.$alerta->id.'.jpg');
    	$Alertas[$key]=$alerta;
    }
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Alertas->toJson();

});

$app->get('/AlertasSinVoluntarioAsignado/:key', function () use ($app){

    $Alertas = \Alerta::where('user_id','0')->get();
    foreach ($Alertas as $key => $alerta) {
    	$alerta->invitado;
    	$alerta->categoria;
    	$alerta->nivel;
        $alerta->user;
    	$alerta->foto=file_exists('../riesg0/archivos/alertas/'.$alerta->id.'.jpg');
    	$Alertas[$key]=$alerta;
    }
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Alertas->toJson();

});
$app->get('/AlertasConVoluntarioAsignado/:key', function () use ($app){

    $Alertas = \Alerta::where('user_id','!=','0')->get();
    foreach ($Alertas as $key => $alerta) {
        $alerta->invitado;
        $alerta->categoria;
        $alerta->nivel;
        $alerta->user;
        $alerta->foto=file_exists('../riesg0/archivos/alertas/'.$alerta->id.'.jpg');
        $Alertas[$key]=$alerta;
    }
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Alertas->toJson();

});

$app->get('/AlertasMisAsignaciones/:user_id/:key', function ($user_id) use ($app){

    $Alertas = \Alerta::where('user_id',$user_id)->where('respuestasalerta_id','0')->get();
    foreach ($Alertas as $key => $alerta) {
        $alerta->invitado;
        $alerta->categoria;
        $alerta->nivel;
        $alerta->user;
        $alerta->foto=file_exists('../riesg0/archivos/alertas/'.$alerta->id.'.jpg');
        $Alertas[$key]=$alerta;
    }
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Alertas->toJson();

});

$app->get('/Alertas/:id/:key', function ($id) use ($app){
    $Alertas = \Alerta::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Alertas){
		$Alertas->invitado;
    	$Alertas->categoria;
    	$Alertas->nivel;
        $Alertas->user;
		$Alertas->foto=file_exists('../riesg0/archivos/alertas/'.$Alertas->id.'.jpg');
    echo $Alertas->toJson();
	}else{
		echo json_encode(array());
	}

});
$app->get('/AlertasDescripcion/:codigo/:id/:key', function ($codigo,$id) use ($app){
	$Alertas = \Alerta::where('codigo' , '=', $codigo)
									  ->where('id','!=',$id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Alertas){
    echo $Alertas->toJson();
	}else{
		echo json_encode(array());
	}

});




$app->post('/Alertas/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['Alerta'])){
		date_default_timezone_set('America/Bogota');
	    $Alertas=new Alerta;
	    formatear($Alertas,$_POST['Alerta']);
	    $Alertas->fecha=date('Y-m-d H:i:s');
		$Alertas->save();
		$foto=$_POST['foto'];
		if(!empty($foto)){
  		file_put_contents("../riesg0/archivos/alertas/".$Alertas->id.'.jpg', base64_decode($foto));
  		}
		$app->response->setStatus(200);
		$Alertas->invitado;
    	$Alertas->categoria;
    	$Alertas->nivel;

    	$Alertas->foto=file_exists('../riesg0/archivos/alertas/'.$Alertas->id.'.jpg');
    	echo $Alertas->toJson();

    	$invitados=\Invitado::where('notificacion',1)->where('id','<>',$Alertas->invitado_id)->where('register_id','<>','')->get();
    	$invitados_array=array();
    	foreach ($invitados as $key => $invitado) {
    		$invitados_array[]=$invitado->register_id;
    	}

    	if(count($invitados_array)>0){
    		$message=$Alertas->invitado->nombres.' Alertó  Sobre '.$Alertas->categoria->descripcion." Nivel ".$Alertas->nivel->descripcion." cerca de ".$Alertas->direccion;
    		$data = array(
			 'message' => $message,
			 'title'=>'Riesg0 te Alerta',
			 'style'=>'picture',
			 'picture'=> "http://riesg0.gyltechnologies.com/archivos/alertas/".$Alertas->id.".jpg?time=".date('YMDHis'),
			 'summaryText'=>$message,
			 "priority"=>2,
			 "notId",$Alertas->id);
    		sendGoogleCloudMessage($data,$invitados_array);



    	}



	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Alertas/:id/:key', function ($id) use ($app){

    $app->response()->headers->set('Content-Type', 'application/json');
    $Alertas = \Alerta::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Alertas){
		if(isset($_REQUEST['Alerta'])){
	    formatear($Alertas,$_POST['Alerta']);
		$Alertas->save();
		$app->response->setStatus(200);
        $Alertas->user;
        $Alertas->invitado;
        $Alertas->categoria;
        $Alertas->nivel;
        $Alertas->foto=file_exists('../riesg0/archivos/alertas/'.$Alertas->id.'.jpg');
    	echo $Alertas->toJson();
	    if(isset($_POST['crear_censo'])&&!empty($_POST['crear_censo'])){
            $municipio_id=\Municipio::where('descripcion',$Alertas->ciudad)->first();
            $message=$Alertas->categoria->descripcion." Nivel ".$Alertas->nivel->descripcion." cerca de ".$Alertas->direccion;
            $censo=new \Censo;
            $censo->municipio_id=$municipio_id->id;
            $censo->descripcion=$message;
            $censo->fecha=date('Y-m-d');
            $censo->tipocenso='ATENCION';
            $censo->nombrecontacto=$_POST['nombrecontacto'];
            $censo->telcontacto=$_POST['telcontacto'];
            $censo->user_id=$Alertas->user_id;
            $censo->save();
        } 

		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});



$app->delete('/Alertas/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Alertas = \Alerta::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Alertas){
		$Alertas_old=$Alertas->toJson();
		$Alertas->delete();
		echo $Alertas_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>