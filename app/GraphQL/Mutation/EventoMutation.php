<?php

namespace App\GraphQL\Mutation;

use Closure;
use App\Models\Evento;
use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;

class EventoMutation extends Mutation
{
    protected $attributes = [
        'name' => 'evento'
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('evento'));
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'nombre' => ['name' => 'nombre', 'type' => Type::string()],
            'fecha' => ['name' => 'fecha', 'type' => Type::string()],
            'hora_inicio' => ['name' => 'hora_inicio', 'type' => Type::string()],
            'hora_fin' => ['name' => 'hora_fin', 'type' => Type::string()],
            'observaciones' => ['name' => 'observaciones', 'type' => Type::string()],
            'estado' => ['name' => 'estado', 'type' => Type::int()],
            'eliminar' => ['name' => 'eliminar', 'type' => Type::int()]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if (isset($args['id'])) {
            $evento = Evento::where('id', $args['id'])->first();
        } else {
            $evento = null;
        }
        if ($evento) {
            if (isset($args['nombre'])) {
                $evento->nombre = $args['nombre'] != '.' ? $args['nombre'] : '';
            }
            if (isset($args['fecha'])) {
                $evento->fecha = $args['fecha'] != '.' ? $args['fecha'] : '';
            }
            if (isset($args['hora_inicio'])) {
                $evento->hora_inicio = $args['hora_inicio'] != '.' ? $args['hora_inicio'] : '';
            }
            if (isset($args['hora_fin'])) {
                $evento->hora_fin = $args['hora_fin'] != '.' ? $args['hora_fin'] : '';
            }
            if (isset($args['observaciones'])) {
                $evento->observaciones = $args['observaciones'] != '.' ? $args['observaciones'] : '';
            }
            if (isset($args['estado'])) {
                $evento->estado = $args['estado'] != '.' ? $args['estado'] : '';
            }

            if (isset($args['eliminar'])) {
                $evento=Evento::where('id', $args['id']);
                $evento->delete();
            }

            $evento->save();            
        } else {
            $evento = Evento::create([
                'nombre' => isset($args['nombre']) && $args['nombre'] != '.' ?  $args['nombre'] : null,
                'fecha' => isset($args['fecha']) && $args['fecha'] != '.' ?  $args['fecha'] : null,
                'hora_inicio' => isset($args['hora_inicio']) && $args['hora_inicio'] != '.' ?  $args['hora_inicio'] : null,
                'hora_fin' => isset($args['hora_fin']) && $args['hora_fin'] != '.' ?  $args['hora_fin'] : null,
                'observaciones' => isset($args['observaciones']) && $args['observaciones'] != '.' ?  $args['observaciones'] : null,
                'estado' => isset($args['estado']) && $args['estado'] != '.' ?  $args['estado'] : null
            ]);
        }

        return $evento;
    }
}