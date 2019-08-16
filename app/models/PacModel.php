<?php 
class Pac extends Illuminate\Database\Eloquent\Model {
    public $timestamps = false;
    protected $table = 'pacs';
    public function capacitaciones()
    {
        return $this->hasMany('\Capacitacion');
    }
}