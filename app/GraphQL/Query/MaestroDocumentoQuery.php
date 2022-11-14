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
            'seccion' => ['name' => 'seccion', 'type' => Type::string()],
            'index' => ['name' => 'index', 'type' => Type::int()],
            '_tipo_documento' => ['name' => '_tipo_documento', 'type' => Type::string()],
            'tipo_documento' => ['name' => 'tipo_documento', 'type' => Type::string()],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $maestroDocumento = MaestroDocumento::all();

        if(isset($args['id']) && $args['id'] !== '.') {
            $maestroDocumento=$maestroDocumento->where('id', $args['id']);
        }
        
        if(isset($args['ubicacion']) && $args['ubicacion'] !== '.') {
            $maestroDocumento=$maestroDocumento->where('ubicacion', $args['ubicacion']);
        }

        if(isset($args['seccion']) && $args['seccion'] !== '.') {
            $maestroDocumento=$maestroDocumento->where('seccion', $args['seccion']);
        }

        if(isset($args['_tipo_documento']) && $args['_tipo_documento'] !== '.') {
            $maestroDocumento=$maestroDocumento->where('tipo_documento', '!=',$args['_tipo_documento']);
        }

        if(isset($args['tipo_documento']) && $args['tipo_documento'] !== '.') {
            $maestroDocumento=$maestroDocumento->where('tipo_documento',$args['tipo_documento']);
        }

        return $maestroDocumento;
    }
}
