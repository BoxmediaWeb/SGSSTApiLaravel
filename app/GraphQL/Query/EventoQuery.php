<?php

namespace App\GraphQL\Query;
use Closure;
use App\Models\Evento;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class EventoQuery extends Query
{
    protected $attributes = [
        'name' => 'The Project Query',
        'description' => 'Retrieves projects'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('evento'));
    }

    public function args(): array
    {
        return [
            'search' => ['name' => 'search', 'type' => Type::string()],
            'fecha' => ['name' => 'fecha', 'type' => Type::string()],
            'orderBy' => ['name' => 'orderBy', 'type' => Type::string()],
            'ordenar' => ['name' => 'ordenar', 'type' => Type::string()],
            'take' => ['name' => 'take', 'type' => Type::int()],
        ];
    }

    public function resolve($root, $args)
    {
        $evento = Evento::all();

        if(isset($args['id']) && $args['id'] !== '.') {
            $evento=$evento->where('id', $args['id']);
        }
        
        if(isset($args['fecha']) && $args['fecha'] !== '.') {
            $evento=$evento->whereDate('fecha', $args['fecha']);
        }

        if(isset($args['orderBy']) && $args['orderBy'] !== '.' && isset($args['ordenar']) && $args['ordenar'] !== '.') {
            if($args['ordenar']=="desc"){
                $evento=$evento->sortByDesc($args['orderBy']);
            }
            if($args['ordenar']=="asc"){
                $evento=$evento->sortBy($args['orderBy']);
            }
        }

        if(isset($args['take']) && $args['take'] !== '.') {
            $evento=$evento->take($args['take']);
        }

        return $evento;
    }
}