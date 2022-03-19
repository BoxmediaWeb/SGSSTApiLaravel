<?php

namespace App\GraphQL\Query;

use Closure;
use App\Models\DetalleDocumento;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Illuminate\Database\Eloquent\Builder;

class DetalleDocumentoQuery extends Query
{
    protected $attributes = [
        'name' => 'detalleDocumento',
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('detalleDocumento'))));
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::id()],
            'search' => ['name' => 'search', 'type' => Type::string()],
            'ubicacion' => ['name' => 'ubicacion', 'type' => Type::string()],
            'id_maestro' => ['name' => 'id_maestro', 'type' => Type::int()]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $detalleDocumento = DetalleDocumento::all();

        if (isset($args['id_maestro']) && $args['id_maestro'] !== '.') {
            $id_maestro = $args['id_maestro'];
            $detalleDocumento = DetalleDocumento::with('maestroDocumento')->whereHas('maestroDocumento', function(Builder $query) use($id_maestro){
                $query->where('id', $id_maestro);
            })->orderBy('id', 'desc')->get();
        }
        
        if (isset($args['ubicacion']) && $args['ubicacion'] !== '.') {
            $ubicacion = $args['ubicacion'];
            $detalleDocumento = DetalleDocumento::with('maestroDocumento')->whereHas('maestroDocumento', function(Builder $query) use($ubicacion){
                $query->where('ubicacion', $ubicacion);
            })->orderBy('id', 'desc')->get();
        }

        return $detalleDocumento;
    }
}
