<?php 
$app->get('/TipoDocumentos/:key', function () use ($app){
    $TipoDocumentos = \TipoDocumento::all();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $TipoDocumentos->toJson();

});



$app->get('/TipoDocumentos/:id/:key', function ($id) use ($app){
    $TipoDocumentos = \TipoDocumento::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($TipoDocumentos){
    echo $TipoDocumentos->toJson();
	}else{
		echo json_encode(array());
	}

});



$app->post('/TipoDocumentos/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['TipoDocumento'])){
	    $TipoDocumentos=new TipoDocumento;
	    formatear($TipoDocumentos,$_POST['TipoDocumento']);
		$TipoDocumentos->save();
		$app->response->setStatus(200);
    	echo $TipoDocumentos->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/TipoDocumentos/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $TipoDocumentos = \TipoDocumento::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($TipoDocumentos){
		if(isset($_REQUEST['TipoDocumento'])){
	    formatear($TipoDocumentos,$_POST['TipoDocumento']);
		$TipoDocumentos->save();
		$app->response->setStatus(200);
    	echo $TipoDocumentos->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});

$app->get('/TipoDocumentosDescripcion/:descripcion/:id/:key', function ($descripcion,$id) use ($app){
	$TipoDocumentos = \TipoDocumento::where('descripcion' , '=', $descripcion)
									  ->where('id','!=',$id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($TipoDocumentos){
    echo $TipoDocumentos->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->delete('/TipoDocumentos/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $TipoDocumentos = \TipoDocumento::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($TipoDocumentos){
		$TipoDocumentos_old=$TipoDocumentos->toJson();
		$TipoDocumentos->delete();
		echo $TipoDocumentos_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>