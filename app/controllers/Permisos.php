<?php 


$app->get('/Opciones/:key', function ($usuario_id) use ($app){
    $Opciones = \Opciones::all();
    foreach ($Opciones as $key => $opcion) {
        $opcion->acciones;
        $Opciones[$key]=$opcion;
    }
    //$Programas->pistas;
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Opciones->toJson(); 

});

$app->get('/Permisos/:key', function ($usuario_id) use ($app){
    $Permisos = \Permiso::all();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    if($Permisos){
    echo $Permisos->toJson();
    }else{
        echo json_encode(array());
    }   

});


$app->get('/PermisosUser/:usuario_id/:key', function ($usuario_id) use ($app){
    $opciones=\Opciones::all();
    $buscar=array();
    
    foreach ($opciones as $key => $opcion) {
        $acciones=$opcion->acciones;
        $opciones[$opcion->id]=$opcion;
        foreach ($acciones as $key => $value) {
        $buscar[]=$value->id;
        }
    }
   
   
    
    $Permisos = \Permiso::where('usuario_id',$usuario_id)->whereIn('accion_id', $buscar)->get();
    $salida=array();
    foreach ($Permisos as $key => $permiso) {
        $tabla=$opciones[$permiso->accion->opciones_id]->descripcion;
        
        $salida[$tabla][]=$permiso->accion->descripcion;
        
    }
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
     echo json_encode($salida);
       

});


$app->get('/PermisosTabla/:usuario_id/:tabla/:key', function ($usuario_id,$tabla) use ($app){
    $opciones=\Opciones::where('descripcion',$tabla)->first();
    $acciones=$opciones->acciones;
    $buscar=array();
    foreach ($acciones as $key => $value) {
        $buscar[]=$value->id;
    }
    $Permisos = \Permiso::where('usuario_id',$usuario_id)->whereIn('accion_id', $buscar)->get();
    $acciones=array();
    foreach ($Permisos as $key => $permiso) {
        $acciones[]=$permiso->accion->descripcion;
        
    }
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
     echo json_encode($acciones);
       

});

$app->post('/Permisos/:usuario_id/:key', function ($usuario_id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
    if(isset($_POST['Permiso'])){
        $Permisos=\Permiso::where('accion_id',$_POST['Permiso']['accion'])->where('usuario_id',$usuario_id)->first();
        if(!$Permisos){
        $Permisos=new Permiso;
        $Permisos->accion_id=$_POST['Permiso']['accion'];
        $Permisos->usuario_id=$usuario_id;
        $Permisos->save();
        }
        $app->response->setStatus(200);
        echo $Permisos->toJson();
    }else{
        $app->response->setStatus(303);
        echo 'Datos No Recibidos';
    }  

});

$app->delete('/Permisos/:usuario_id/:accion_id/:key', function ($usuario_id,$accion_id) use ($app){
        $app->response()->headers->set('Content-Type', 'application/json');
        $Permisos=\Permiso::where('accion_id',$accion_id)->where('usuario_id',$usuario_id)->first();
        $Permisos_old=$Permisos->toJson();
        $Permisos->delete();
        $app->response->setStatus(200);
        echo $Permisos_old;

     

});

$app->get('/PermisosList/:usuario_id/:key', function ($usuario_id) use ($app){
    $Permisos = \Permiso::where('usuario_id' , '=', $usuario_id)->get();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    if($Permisos){
    echo $Permisos->toJson();
	}else{
		echo json_encode(array());
	}   

});


$app->get('/PermisosList/:usuario_id/:key', function ($usuario_id) use ($app){
    $Permisos = \Permiso::where('usuario_id' , '=', $usuario_id)->get();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    if($Permisos){
    echo $Permisos->toJson();
    }else{
        echo json_encode(array());
    }   

});





?>