<?php 
class Afectacion extends Illuminate\Database\Eloquent\Model {
    public $timestamps = true;
    protected $table = 'afectaciones';
       public function ayudas()
    {
        return $this->hasMany('\Ayuda');
    }

    
}