<?php 
$app->get('/Roles/:key', function () use ($app){
    $Roles = \Role::all();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Roles->toJson();

});

$app->get('/Roles/:role_id/:key', function ($role_id) use ($app){
    $Roles = \Role::where('id',$role_id)->first();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo $Roles->toJson();

});


?>