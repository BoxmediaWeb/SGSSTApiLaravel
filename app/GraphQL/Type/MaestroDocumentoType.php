<?php

namespace App\GraphQL\Type;

use App\Models\MaestroDocumento;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class MaestroDocumentoType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'maestroDocumento',
        'description'   => 'Lista de patrones de documentos existentes',
        'model'         => MaestroDocumento::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
            ],
            'codigo' => [
                'type' => Type::string(),
            ],
            'seccion' => [
                'type' => Type::int(),
            ],
            'estandar' => [
                'type' => Type::int(),
            ],
            'empresa_id' => [
                'type' => Type::int(),
            ],
            'vigencia' => [
                'type' => Type::string(),
            ],
            'extencion' => [
                'type' => Type::string(),
            ],
            'nombre' => [
                'type' => Type::string(),
            ],
            'nombre_corto' => [
                'type' => Type::string(),
            ],
            'ubicacion' => [
                'type' => Type::string(),
            ],
            'tipo_documento' => [
                'type' => Type::string(),
            ],
            'enlace_modelo' => [
                'type' => Type::string(),
            ],
            'sistema' => [
                'type' => Type::string(),
            ],
            'observaciones' => [
                'type' => Type::string(),
            ],
            'estado' => [
                'type' => Type::int(),
            ],
            'detalleDocumento' => [
                'type' => GraphQL::type('detalleDocumento')
            ],
            /*
            'created_at' => [
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