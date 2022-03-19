<?php

namespace App\GraphQL\Type;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'user',
        'description' => 'A User Type',
        'model' => User::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'El id del usuario'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'El nombre del usuario'
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'El email del usuario'
            ],
            'avatar' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'El avatar del usuario'
            ],
        ];
    }
}