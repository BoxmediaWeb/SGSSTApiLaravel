<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaestroDocumento extends Model
{
    protected $table = 'maestro_documentos';

    protected $guarded = [
        'id'
    ];

    
    public function detalleDocumento()
    {
        return $this->hasOne('App\Models\DetalleDocumento','maestro_id');
    }
    
}
