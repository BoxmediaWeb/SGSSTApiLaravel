<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleDocumento extends Model
{
    protected $table = 'detalle_documentos';

    protected $guarded = [
        'id'
    ];

    public function maestroDocumento()
    {
        return $this->belongsTo('App\Models\MaestroDocumento', 'maestro_id');
    }

}