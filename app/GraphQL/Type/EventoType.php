<?php

namespace App\GraphQL\Type;

use App\Models\Evento;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class EventoType extends GraphQLType
{
    protected $attributes = [
        'name' => 'evento',
        'description' => 'Eventos programados',
        'model' => Evento::class
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
            'fecha' => [
                'type' => Type::string(),
                'description' => 'Descripción del rol'
            ],
            'hora_inicio' => [
                'type' => Type::string(),
                'description' => 'Descripción del rol'
            ],
            'hora_fin' => [
                'type' => Type::string(),
                'description' => 'Descripción del rol'
            ],
            'observaciones' => [
                'type' => Type::string(),
                'description' => 'Descripción del rol'
            ],
            'estado' => [
                'type' => Type::int(),
                'description' => 'Descripción del rol'
            ]
        ];
    }
}