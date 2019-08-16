<?php 
class PistaPrograma extends Illuminate\Database\Eloquent\Model {
    public $timestamps = false;
    protected $table = 'pista_programa';
    public function ayudas()
    {
        return $this->hasMany('\Ayuda');
    }
}