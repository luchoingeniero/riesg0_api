<?php 
class Escenario extends Illuminate\Database\Eloquent\Model {
    public $timestamps = false;
    protected $table = 'escenarios';
    
    public function comunidades()
    {
        return $this->belongsToMany('\Comunidad');
    }
}