<?php 
$app->get('/Departamentos/:key', function () use ($app){
    $Departamentos = \Departamento::all();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Departamentos->toJson();

});

$app->get('/Departamentos/:id/:key', function ($id) use ($app){
    $Departamentos = \Departamento::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($Departamentos){
    echo $Departamentos->toJson();
	}else{
		echo json_encode(array());
	}


});

$app->get('/Municipios/:key', function () use ($app){
    $municipios = \Municipio::all();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    if($municipios){
    echo $municipios->toJson();
	}else{
		echo json_encode(array());
	}

    

});

$app->get('/Municipios/:id/:key', function ($id) use ($app){
    $municipios = \Municipio::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    if($municipios){
    echo $municipios->toJson();
    }else{
        echo json_encode(array());
    }


});


$app->get('/MunicipiosList/:departamento_id/:key', function ($departamento_id) use ($app){
    $municipios = \Municipio::where('departamento_id' , '=', $departamento_id)->get();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    if($municipios){
    echo $municipios->toJson();
	}else{
		echo json_encode(array());
	}

    

});





?>