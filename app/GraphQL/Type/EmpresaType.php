<?php

namespace App\GraphQL\Type;

use App\Models\Empresa;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class EmpresaType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'empresa',
        'description'   => 'Una Empresa',
        'model'         => Empresa::class,
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
            'prefijo' => [
                'type' => Type::string(),
            ],
            'razon_social' => [
                'type' => Type::string(),
            ],
            'ruc' => [
                'type' => Type::string(),
            ],
            'direccion' => [
                'type' => Type::string(),
            ],
            'celular' => [
                'type' => Type::string(),
            ],
            'web' => [
                'type' => Type::string(),
            ],
            'correo' => [
                'type' => Type::string(),
            ]
        ];
    }


}