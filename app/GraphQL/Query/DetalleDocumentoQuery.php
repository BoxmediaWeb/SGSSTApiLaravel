<?php

namespace App\GraphQL\Query;

use Closure;
use App\Models\DetalleDocumento;
use App\Models\MaestroDocumento;
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
            'id_maestro' => ['name' => 'id_maestro', 'type' => Type::int()],
            'index_maestro' => ['name' => 'index_maestro', 'type' => Type::int()],
            'limpiar' => ['name' => 'limpiar', 'type' => Type::int()],
            '_tipo_documento' => ['name' => '_tipo_documento', 'type' => Type::string()],
            'tipo_documento' => ['name' => 'tipo_documento', 'type' => Type::string()],
            'vigencia' => ['name' => 'vigencia', 'type' => Type::string()],
            'take' => ['name' => 'take', 'type' => Type::int()],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $detalleDocumento = DetalleDocumento::query();

        if (isset($args['id_maestro']) && $args['id_maestro'] !== '.') {
            $id_maestro = $args['id_maestro'];
            $detalleDocumento = $detalleDocumento->with('maestroDocumento')->whereHas('maestroDocumento', function(Builder $query) use($id_maestro){
                $query->where('id', $id_maestro);
            })->orderBy('id', 'desc');
        }

        if (isset($args['ubicacion']) && $args['ubicacion'] !== '.') {
            $ubicacion = $args['ubicacion'];
            $detalleDocumento = $detalleDocumento->with('maestroDocumento')->whereHas('maestroDocumento', function(Builder $query) use($ubicacion){
                $query->where('ubicacion', $ubicacion);
            })->orderBy('id', 'desc');
        }

        if (isset($args['_tipo_documento']) && $args['_tipo_documento'] !== '.') {
            $_tipo_documento = $args['_tipo_documento'];
            $detalleDocumento = $detalleDocumento->with('maestroDocumento')->whereHas('maestroDocumento', function(Builder $query) use($_tipo_documento){
                $query->where('tipo_documento', '!=', $_tipo_documento);
            })->orderBy('id', 'desc');
        }

        if (isset($args['tipo_documento']) && $args['tipo_documento'] !== '.') {
            $tipo_documento = $args['tipo_documento'];
            $detalleDocumento = $detalleDocumento->with('maestroDocumento')->whereHas('maestroDocumento', function(Builder $query) use($tipo_documento){
                $query->where('tipo_documento', $tipo_documento);
            })->orderBy('id', 'desc');
        }

        if(isset($args['index_maestro']) && $args['index_maestro'] !== '.') {
            if(isset($args['ubicacion']) && $args['ubicacion'] !== '.') {
                $maestroDocumento = MaestroDocumento::where('ubicacion', $args['ubicacion'])->where('tipo_documento', '!=', "Documento")->skip($args['index_maestro'])->take(1)->first()->id;
                $detalleDocumento = $detalleDocumento->where('maestro_id', $maestroDocumento);
            }
        }

        if(isset($args['take']) && $args['take'] !== '.') {
            $detalleDocumento=$detalleDocumento->take($args['take']);
        }

        return $detalleDocumento->get();
    }
}
