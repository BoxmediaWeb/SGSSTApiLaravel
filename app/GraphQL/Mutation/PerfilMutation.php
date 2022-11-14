<?php

namespace App\GraphQL\Mutation;

use Closure;
use App\Models\Perfil;
use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;

class PerfilMutation extends Mutation
{
    protected $attributes = [
        'name' => 'perfil'
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('perfil'));
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'nombres' => ['name' => 'name', 'type' => Type::string()],
            'apellidos' => ['name' => 'email', 'type' => Type::string()],
            'fecha' => ['name' => 'password', 'type' => Type::string()],
            'cargo' => ['name' => 'avatar', 'type' => Type::string()],
            'empresa' => ['name' => 'avatar', 'type' => Type::string()],
            'telefono' => ['name' => 'avatar', 'type' => Type::string()],
            'usuario_id' => ['name' => 'avatar', 'type' => Type::int()]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if (isset($args['id'])) {
            $perfil = Perfil::where('id', $args['id'])->first();
        } else {
            $perfil = null;
        }
        if ($perfil) {
            if (isset($args['nombres'])) {
                $perfil->nombres = $args['nombres'] != '.' ? $args['nombres'] : '';
            }
            if (isset($args['apellidos'])) {
                $perfil->apellidos = $args['apellidos'] != '.' ? $args['apellidos'] : '';
            }
            if (isset($args['fecha'])) {
                $perfil->fecha = $args['fecha'] != '.' ? $args['fecha'] : '';
            }
            if (isset($args['cargo'])) {
                $perfil->cargo = $args['cargo'] != '.' ? $args['cargo'] : '';
            }
            if (isset($args['empresa'])) {
                $perfil->empresa = $args['empresa'] != '.' ? $args['empresa'] : '';
            }
            if (isset($args['telefono'])) {
                $perfil->telefono = $args['telefono'] != '.' ? $args['telefono'] : '';
            }
            if (isset($args['usuario_id'])) {
                $perfil->usuario_id = $args['usuario_id'] != '.' ? $args['usuario_id'] : '';
            }
            $perfil->save();            
        } else {
            $perfil = Perfil::create([
                'nombres' => isset($args['nombres']) && $args['nombres'] != '.' ?  $args['nombres'] : null,
                'apellidos' => isset($args['apellidos']) && $args['apellidos'] != '.' ?  $args['apellidos'] : null,
                'fecha' => isset($args['fecha']) && $args['fecha'] != '.' ?  $args['fecha'] : null,
                'cargo' => isset($args['cargo']) && $args['cargo'] != '.' ?  $args['cargo'] : null,
                'empresa' => isset($args['empresa']) && $args['empresa'] != '.' ?  $args['empresa'] : null,
                'telefono' => isset($args['telefono']) && $args['telefono'] != '.' ?  $args['telefono'] : null,
                'usuario_id' => isset($args['usuario_id']) && $args['usuario_id'] != '.' ?  $args['usuario_id'] : null
            ]);
        }

        return $perfil;
    }
}