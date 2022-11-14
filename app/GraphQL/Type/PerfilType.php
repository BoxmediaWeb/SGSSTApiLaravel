<?php

namespace App\GraphQL\Type;

use App\Models\Perfil;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PerfilType extends GraphQLType
{
    protected $attributes = [
        'name' => 'perfil',
        'description' => 'A Role Type',
        'model' => Perfil::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'El id del rol'
            ],
            'nombres' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Nombre del rol'
            ],
            'apellidos' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Descripción del rol'
            ],
            'fecha' => [
                'type' => Type::string(),
                'description' => 'Descripción del rol'
            ],
            'cargo' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Descripción del rol'
            ],
            'empresa' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Descripción del rol'
            ],
            'telefono' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Descripción del rol'
            ],
            'usuario_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Descripción del rol'
            ],
            'user' => [
                'type' => GraphQL::type('user')
            ],
        ];
    }
}