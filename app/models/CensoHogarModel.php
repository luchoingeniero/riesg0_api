<?php 
class CensoHogar extends Illuminate\Database\Eloquent\Model {
    public $timestamps = false;
    protected $table = 'censo_hogar';
 
    public function afectaciones()
    {
        return $this->hasMany('\Afectacion');
    }
}