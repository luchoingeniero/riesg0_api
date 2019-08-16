<?php 
class Censo extends Illuminate\Database\Eloquent\Model {
    public $timestamps = false;
    protected $table = 'censos';

    public function hogares()
    {
        return $this->belongsToMany('\Hogar');
    }
}