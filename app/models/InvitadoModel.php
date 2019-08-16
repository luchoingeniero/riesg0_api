<?php 
class Invitado extends Illuminate\Database\Eloquent\Model {
    public $timestamps = false;
    protected $table = 'invitados';
    
    public function alertas()
    {
        return $this->hasMany('\Alerta');
    }

}