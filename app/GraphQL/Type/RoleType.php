<?php

namespace App\GraphQL\Type;

use App\Models\Role;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class RoleType extends GraphQLType
{
    protected $attributes = [
        'name' => 'role',
        'description' => 'A Role Type',
        'model' => Role::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'El id del rol'
            ],
            'nombre' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Nombre del rol'
            ],
            'descripcion' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Descripción del rol'
            ],
            'user' => [
                'type' => GraphQL::type('user')
            ]
        ];
    }
}