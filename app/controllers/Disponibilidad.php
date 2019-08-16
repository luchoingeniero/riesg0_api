<?php 
$app->get('/DisponibilidadList/:usuario_id/:key', function ($usuario_id) use ($app){
    $Disponibilidad = \Disponibilidad::where('usuario_id',$usuario_id)->get();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Disponibilidad->toJson();

});
$app->get('/Disponibilidad/:id/:key', function ($id) use ($app){
    $Disponibilidad = \Disponibilidad::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Disponibilidad){
    echo $Disponibilidad->toJson();
	}else{
		echo json_encode(array());
	}

});


$app->get('/DisponibilidadUsuarios/:key', function () use ($app){
	$app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	
	$dayNames = array(
    'Sunday'=>"DOMINGO",
    'Monday'=>"LUNES", 
    'Tuesday'=>"MARTES", 
    'Wednesday'=>"MIERCOLES", 
    'Thursday'=>"JUEVES", 
    'Friday'=>"VIERNES", 
    'Saturday'=>"SABADO", 
 );

	$nowUtc = new DateTime( 'now',  new \DateTimeZone( 'America/Bogota' ) );
	$dia=$dayNames[$nowUtc->format('l')];
	
	$hora_actual=$nowUtc->format('H:i');
	$hora_opcional=date ( 'H:i' ,strtotime ( '+1 hour' , strtotime($nowUtc->format('H:i')) ) );
 

	$Disponibilidad = \Disponibilidad::where('dia',$dia)
									 ->where('hora_final','>=',$hora_actual)
									 ->where(function($q)use($hora_actual,$hora_opcional){
									         return  $q->Where('hora_inicial','<=',$hora_actual)
									  			->orWhere('hora_inicial','<=',$hora_opcional);
									      })
									 ->get();


    
	if($Disponibilidad){
		$usuarios=array();
		foreach ($Disponibilidad as $key => $d) {
			$usuarios[]=$d->Usuario;
			//$Disponibilidad[$key]=$d;
			# code...
		}

    echo json_encode($usuarios);
	}else{
		echo json_encode(array());
	}

});


$app->post('/Disponibilidad/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['Disponibilidad'])){
	    $Disponibilidad=new Disponibilidad;
	    formatear($Disponibilidad,$_POST['Disponibilidad']);
		$Disponibilidad->save();
		$app->response->setStatus(200);
    	echo $Disponibilidad->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Disponibilidad/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Disponibilidad = \Disponibilidad::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Disponibilidad){
		if(isset($_REQUEST['Disponibilidad'])){
	    formatear($Disponibilidad,$_POST['Disponibilidad']);
		$Disponibilidad->save();
		$app->response->setStatus(200);
    	echo $Disponibilidad->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});


$app->get('/DisponibilidadDescripcion/:descripcion/:usuario_id/:id/:key', function ($descripcion,$usuario_id,$id) use ($app){
	$Disponibilidad = \Disponibilidad::where('dia' , '=', $descripcion)
									  ->where('usuario_id','=',$usuario_id) 
									  ->where('id','!=',$id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Disponibilidad){
    echo $Disponibilidad->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->delete('/Disponibilidad/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Disponibilidad = \Disponibilidad::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Disponibilidad){
		$Disponibilidad_old=$Disponibilidad->toJson();
		$Disponibilidad->delete();
		echo $Disponibilidad_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>