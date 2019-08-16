<?php 
class Permiso extends Illuminate\Database\Eloquent\Model {
    public $timestamps = false;
    protected $table = 'permisos';

    public function accion()
    {
        return $this->belongsTo('\Acciones');
    }
}