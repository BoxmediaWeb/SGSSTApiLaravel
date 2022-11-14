<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model

{
    protected $table = 'perfiles';
    protected $guarded = [
        'id'
    ];

    /*
    public function User()
    {
        return $this->belongsTo('App\Models\User', 'usuario_id', 'id');
        return $this->belongsTo('App\Models\Perfil');
    }*/

    public function User()
    {
        return $this->belongsTo('App\Models\User', 'usuario_id', 'id');
    }

}
