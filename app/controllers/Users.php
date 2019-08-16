<?php 

$app->post('/UsersLogin/:nick/:password/:key', function ($nick,$password) use ($app){
    $users = \User::where('login' , '=', $nick)
				  ->where('password','=',md5($password))
				  ->first();

    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    if($users){
    	$users->role;
    	echo $users->toJson();}
    else{ echo  json_encode(array());}
    

});

$app->get('/UsersList/:role_id/:key', function ($role_id) use ($app){
	$users= \User::where('role_id',$role_id)->get();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($users){
    echo $users->toJson();
	}else{
		echo json_encode(array());
	}

});


$app->get('/Users/:key', function () use ($app){
    $users = \User::all();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $users->toJson();

});


$app->get('/Users/:id/:key', function ($id) use ($app){
   $users = \User::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($users){
    echo$users->toJson();
	}else{
		echo json_encode(array());
	}

});



$app->post('/Users/:key', function () use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
	if(isset($_POST['User'])){
	   $users=new User;
	    $_POST['User']['password']=md5($_POST['User']['password']);
	    formatear($users,$_POST['User']);
		$users->save();
		$foto=$_POST['foto'];
		if(!empty($foto)){
  		file_put_contents("../riesg0/archivos/users/".$Invitados->id.'.jpg', base64_decode($foto));
  		}

		$app->response->setStatus(200);
    	echo$users->toJson();
	}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
	}


});

$app->post('/Users/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
   $users = \User::find($id);
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($users){
		if(isset($_REQUEST['User'])){
		 if($_POST['User']['password']==$_POST['password_old']){
		 	unset($_POST['User']['password']);
		 }else{
		 	$_POST['User']['password']=md5($_POST['User']['password']);
		 }	
	    formatear($users,$_POST['User']);
		$users->save();
		$foto=$_POST['foto'];
		if(!empty($foto)){
  		file_put_contents("../riesg0/archivos/users/".$Invitados->id.'.jpg', base64_decode($foto));
  		}
		$app->response->setStatus(200);
    	echo$users->toJson();
		
		}else{
		$app->response->setStatus(303);
		echo 'Datos No Recibidos';
		}
		
    }else{
		echo json_encode(array());
	}

	


});

$app->get('/UsersDescripcion/:nick/:id/:key', function ($nick,$id) use ($app){
	$users = \User::where('login' , '=', $nick)
									  ->where('id','!=',$id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($users){
    echo $users->toJson();
	}else{
		echo json_encode(array());
	}

});

$app->delete('/Users/:id/:key', function ($id) use ($app){
    $app->response()->headers->set('Content-Type', 'application/json');
   $users = \User::find($id);
    
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
	if($users){
		$users_old=$users->toJson();
		$users->delete();
		echo$users_old;
		
    }else{
		echo json_encode(array());
	}

	


});



?>