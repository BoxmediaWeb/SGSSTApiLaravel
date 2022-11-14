<?php

namespace App\GraphQL\Query;

use Closure;
use App\Models\Perfil;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class PerfilQuery extends Query
{
    protected $attributes = [
        'name' => 'The Project Query',
        'description' => 'Retrieves projects'
    ];


    public function type(): Type
    {
        return Type::listOf(GraphQL::type('perfil'));
    }

    public function args(): array
    {
        return [
            'search' => ['name' => 'search', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        return Perfil::all();
    }
}