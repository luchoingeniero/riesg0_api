<?php 


$app->get('/CensosHogaresAtendidos/:key', function () use ($app){
    
    $count = \CensoHogar::all()->count();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo json_encode($count);

});

$app->get('/CensosHogaresIntegrantes/:key', function () use ($app){
    
    $count = \Integranteshogar::all()->count();
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo json_encode($count);

});



$app->get('/CensosHogaresAyudasEntregadas/:key', function () use ($app){
     $count= $app->db->table("hogares_ayudas_entregadas")->count();
    /*$count = \DB::select("select count(*) as nro_hogares from (SELECT distinct ch.hogar_id FROM censos c,censo_hogar ch,afectaciones a,ayudas ay
where c.id=ch.censo_id and ch.id=a.censo_hogar_id and a.id=ay.id and ay.entregado='SI') as t1");*/
    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo json_encode($count);

});


$app->get('/CensosIntegrantesEdades/:key', function () use ($app){
    $mujeres =$app->db->table("integrantes_edades")->where('genero',"F")->get();
    $hombres =$app->db->table("integrantes_edades")->where('genero',"M")->get();
    $rangos=array('0-2','3-6','7-13','14-17','18-30','31-55','56-80','80+');
    $datos_hombres=array();
    $datos_mujeres=array();

    foreach ($rangos as $key => $rango) {
        $datos_mujeres[$rango]=0;
        $datos_hombres[$rango]=0;
    }

    
    foreach ($mujeres as $key => $obj_) {
        if($obj_->edad>=0&&$obj_->edad<=2){
            $datos_mujeres['0-2']+=$obj_->registros*-1;
        }else if($obj_->edad>=3&&$obj_->edad<=6){
            $datos_mujeres['3-6']+=$obj_->registros*-1;
        }else if($obj_->edad>=7&&$obj_->edad<=13){
            $datos_mujeres['7-13']+=$obj_->registros*-1;
        }else if($obj_->edad>=14&&$obj_->edad<=17){
            $datos_mujeres['14-17']+=$obj_->registros*-1;
        }else if($obj_->edad>=18&&$obj_->edad<=30){
            $datos_mujeres['18-30']+=$obj_->registros*-1;
        }else if($obj_->edad>=31&&$obj_->edad<=55){
            $datos_mujeres['31-55']+=$obj_->registros*-1;
        }else if($obj_->edad>=56&&$obj_->edad<=80){
            $datos_mujeres['56-80']+=$obj_->registros*-1;
        }
        else if($obj_->edad>80){
            $datos_mujeres['80+']+=$obj_->registros*-1;
        }
    }
    
    foreach ($hombres as $key => $obj_) {
        if($obj_->edad>=0&&$obj_->edad<=2){
            $datos_hombres['0-2']+=$obj_->registros;
        }else if($obj_->edad>=3&&$obj_->edad<=6){
            $datos_hombres['3-6']+=$obj_->registros;
        }else if($obj_->edad>=7&&$obj_->edad<=13){
            $datos_hombres['7-13']+=$obj_->registros;
        }else if($obj_->edad>=14&&$obj_->edad<=17){
            $datos_hombres['14-17']+=$obj_->registros;
        }else if($obj_->edad>=18&&$obj_->edad<=30){
            $datos_hombres['18-30']+=$obj_->registros;
        }else if($obj_->edad>=31&&$obj_->edad<=55){
            $datos_hombres['31-55']+=$obj_->registros;
        }else if($obj_->edad>=56&&$obj_->edad<=80){
            $datos_hombres['56-80']+=$obj_->registros;
        }
        else if($obj_->edad>80){
            $datos_hombres['80+']+=$obj_->registros;
        }
    }

    $datos_salida_hombres=array();
    $datos_salida_mujeres=array();
    foreach ($rangos as $key => $rango) {
        $datos_salida_mujeres[]=$datos_mujeres[$rango];
        $datos_salida_hombres[]=$datos_hombres[$rango];
    }

    $salida=array('rangos'=>$rangos,'M'=>$datos_salida_hombres,'F'=>$datos_salida_mujeres);

    $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo  json_encode($salida);
});


$app->get('/CensosMunicipios/:key', function () use ($app){
     $rs= $app->db->table("censosmunicipios")->get();
     $app->response->setStatus(200);
    $app->response()->headers->set('Content-Type', 'application/json');
    echo json_encode($rs);

});




?>