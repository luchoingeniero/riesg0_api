<?php 
class Alerta extends Illuminate\Database\Eloquent\Model {
    public $timestamps = false;
    protected $table = 'alertas';
    
    public function invitado()
    {
        return $this->belongsTo('\Invitado');
    }
    public function user()
    {
        return $this->belongsTo('\User');
    }
    public function categoria()
    {
        return $this->belongsTo('\Categoria');
    }
    public function nivel()
    {
        return $this->belongsTo('\Nivel');
    }

}