<?php 
$app->get('/Categorias/:key', function () use ($app){
    $Categorias = \Categoria::all();
    $callback=isset($_GET['callback'])?$_GET['callback'].'(':'';
    $cerrar_calback=(empty($callback))?'':');';	

    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    
     echo $callback.''.$Categorias->toJson().$cerrar_calback;

});
$app->get('/Categorias/:id/:key', function ($id) use ($app){
    $Categorias = \Categoria::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Categorias){
    echo $Categorias->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->post('/Categorias/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['Categoria'])){
	    $Categorias=new Categoria;
	    formatear($Categorias,$_POST['Categoria']);
		$Categorias->save();
		$app->response->setStatus(200);
    	echo $Categorias->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Categorias/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Categorias = \Categoria::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Categorias){
		if(isset($_REQUEST['Categoria'])){
	    formatear($Categorias,$_POST['Categoria']);
		$Categorias->save();
		$app->response->setStatus(200);
    	echo $Categorias->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});


$app->get('/CategoriasDescripcion/:descripcion/:id/:key', function ($descripcion,$id) use ($app){
	$Categorias = \Categoria::where('descripcion' , '=', $descripcion)
									  ->where('id','!=',$id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Categorias){
    echo $Categorias->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->delete('/Categorias/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    $Categorias = \Categoria::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Categorias){
		$Categorias_old=$Categorias->toJson();
		$Categorias->delete();
		echo $Categorias_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>