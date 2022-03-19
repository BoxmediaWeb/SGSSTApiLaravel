<?php

namespace App\GraphQL\Type;

use App\Models\DetalleDocumento;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class DetalleDocumentoType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'detalleDocumento',
        'description'   => 'el detalle del documento',
        // Note: only necessary if you use `SelectFields`
        'model'         => DetalleDocumento::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
            ],
            'maestro_id' => [
                'type' => Type::int(),
            ],
            'version' => [
                'type' => Type::string(),
            ],
            'ubicacion' => [
                'type' => Type::string(),
            ],
            'fecha' => [
                'type' => Type::string(),
            ],
            'comentario' => [
                'type' => Type::string(),
            ],
            'usuario' => [
                'type' => Type::string(),
            ],
            'estado' => [
                'type' => Type::int(),
            ],
            'rev' => [
                'type' => Type::string(),
            ],
            'maestroDocumento' => [
                'type' => GraphQL::type('maestroDocumento')
            ],
            /*'created_at' => [
                'type' => Timestamp::type(),
                'description' => 'The email of user'
            ],
            'updated_at' => [
                'type' => Timestamp::type(),
                'description' => 'The email of user'
            ]*/
        ];
    }

}