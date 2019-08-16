<?php 
class Programa extends Illuminate\Database\Eloquent\Model {
    public $timestamps = false;
    protected $table = 'programas';
    public function temas()
    {
        return $this->hasMany('\Tema');
    }
    public function pistas()
    {
        return $this->belongsToMany('\Pista');
    }
}