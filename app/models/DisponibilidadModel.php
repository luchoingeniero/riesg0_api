<?php 
class Disponibilidad extends Illuminate\Database\Eloquent\Model {
    public $timestamps = false;
    protected $table = 'disponibilidad';
    
    public function Usuario()
    {
        return $this->belongsTo('User');
    }

  
}