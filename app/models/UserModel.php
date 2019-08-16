<?php 
class User extends Illuminate\Database\Eloquent\Model {
    public $timestamps = false;
    protected $table = 'users';
    public function role()
    {
        return $this->belongsTo('Role');
    }
}