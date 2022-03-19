<?php
namespace App\GraphQL\Query;

use Closure;
use App\Models\MaestroDocumento;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;



class MaestroDocumentoQuery extends Query
{
    protected $attributes = [
        'name' => 'maestroDocumento',
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('maestroDocumento'))));
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::id()],
            'search' => ['name' => 'search', 'type' => Type::string()],
            'ubicacion' => ['name' => 'ubicacion', 'type' => Type::string()],
            'seccion' => ['name' => 'seccion', 'type' => Type::string()]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $maestroDocumento = MaestroDocumento::all();

        if(isset($args['id']) && $args['id'] !== '.') {
            $maestroDocumento = MaestroDocumento::where('id', $args['id'])->get();
        }
        
        if(isset($args['ubicacion']) && $args['ubicacion'] !== '.') {
            $maestroDocumento = MaestroDocumento::where('ubicacion', $args['ubicacion'])->get();
        }

        if(isset($args['seccion']) && $args['seccion'] !== '.') {
            $maestroDocumento = MaestroDocumento::where('seccion', $args['seccion'])->get();
        }
        
        return $maestroDocumento;
    }
}
