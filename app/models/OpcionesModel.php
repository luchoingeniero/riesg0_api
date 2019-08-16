<?php 
class Opciones extends Illuminate\Database\Eloquent\Model {
    public $timestamps = false;
    protected $table = 'opciones';
    
   public function acciones()
    {
        return $this->hasMany('\Acciones');
    }

}