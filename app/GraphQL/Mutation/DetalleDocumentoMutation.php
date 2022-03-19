<?php

namespace App\GraphQL\Mutation;

use Closure;
use App\Models\DetalleDocumento;
use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\File; 

class DetalleDocumentoMutation extends Mutation
{
    protected $attributes = [
        'name' => 'detalleDocumento'
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('detalleDocumento'));
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'version' => ['name' => 'version', 'type' => Type::int()],
            'estado' => ['name' => 'estado', 'type' => Type::int()],
            'comentario' => ['name' => 'comentario', 'type' => Type::string()],
            'maestro_id' => ['name' => 'maestro_id', 'type' => Type::int()],
            'ubicacion' => ['name' => 'ubicacion', 'type' => Type::string()],
            'usuario' => ['name' => 'usuario', 'type' => Type::string()],
            'fecha' => ['name' => 'fecha', 'type' => Type::string()],
            'eliminar' => ['name' => 'eliminar', 'type' => Type::int()]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if (isset($args['id'])) {
            $detalleDocumento = DetalleDocumento::where('id', $args['id'])->first();
        } else {
            $detalleDocumento = null;
        }

        if ($detalleDocumento) {
            if (isset($args['version'])) {
                $detalleDocumento->version = $args['version'] != '.' ? $args['version'] : '';
            }

            if (isset($args['estado'])) {
                $detalleDocumento->estado = $args['estado'] != '.' ? $args['estado'] : '';
            }

            if (isset($args['comentario'])) {
                $detalleDocumento->comentario = $args['comentario'] != '.' ? $args['comentario'] : '';
            }

            if (isset($args['maestro_id'])) {
                $detalleDocumento->maestro_id = $args['maestro_id'] != '.' ? $args['maestro_id'] : '';
            }

            if (isset($args['ubicacion'])) {
                $detalleDocumento->ubicacion = $args['ubicacion'] != '.' ? $args['ubicacion'] : '';
            }

            if (isset($args['usuario'])) {
                $detalleDocumento->usuario = $args['usuario'] != '.' ? $args['usuario'] : '';
            }

            if (isset($args['fecha'])) {
                $detalleDocumento->fecha = $args['fecha'] != '.' ? $args['fecha'] : '';
            }

            if (isset($args['eliminar'])) {
                //$detalleDocumento->delete();
                $detalleDocumento=DetalleDocumento::where('id', $args['id']);
                File::delete(public_path().'/detalle_documento/'.$detalleDocumento->first()->ubicacion);
                $detalleDocumento->delete();
            }

            $detalleDocumento->save();            
        } else {

            $detalleDocumento = DetalleDocumento::create([
                'version' => isset($args['version']) && $args['version'] != '.' ?  $args['version'] : null,
                'estado' => isset($args['estado']) && $args['estado'] != '.' ?  $args['estado'] : null,
                'comentario' => isset($args['comentario']) && $args['comentario'] != '.' ?  $args['comentario'] : null,
                'maestro_id' => isset($args['maestro_id']) && $args['maestro_id'] != '.' ?  $args['maestro_id'] : null,
                'ubicacion' => isset($args['ubicacion']) && $args['ubicacion'] != '.' ?  $args['ubicacion'] : null,
                'usuario' => isset($args['usuario']) && $args['usuario'] != '.' ?  $args['usuario'] : null,
                'fecha' => isset($args['fecha']) && $args['fecha'] != '.' ?  $args['fecha'] : null,
            ]);
        }

        return $detalleDocumento;
    }
}