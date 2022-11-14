<?php

namespace App\GraphQL\Mutation;

use Closure;
use App\Models\User;
use App\Models\Perfil;
use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;

class UserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'user'
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('user'));
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'role_id' => ['name' => 'role_id', 'type' => Type::int()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'email' => ['name' => 'email', 'type' => Type::string()],
            'password' => ['name' => 'password', 'type' => Type::string()],
            'avatar' => ['name' => 'avatar', 'type' => Type::string()],
            'nickname' => ['name' => 'nickname', 'type' => Type::string()],
            'perfil_nombres' => ['name' => 'perfil_nombres', 'type' => Type::string()],
            'perfil_apellidos' => ['name' => 'perfil_apellidos', 'type' => Type::string()],
            'perfil_fecha' => ['name' => 'perfil_fecha', 'type' => Type::string()],
            'perfil_cargo' => ['name' => 'perfil_cargo', 'type' => Type::string()],
            'perfil_empresa' => ['name' => 'perfil_empresa', 'type' => Type::string()],
            'perfil_telefono' => ['name' => 'perfil_telefono', 'type' => Type::string()],
            'delete' => ['name' => 'delete', 'type' => Type::int()]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if (isset($args['id'])) {
            $user = User::where('id', $args['id'])->first();
        } else {
            $user = null;
        }
        if ($user) {
            if (isset($args['name'])) {
                $user->name = $args['name'] != '.' ? $args['name'] : '';
            }
            if (isset($args['role_id'])) {
                $user->role_id = $args['role_id'] != '.' ? $args['role_id'] : '';
            }
            if (isset($args['email'])) {
                $user->email = $args['email'] != '.' ? $args['email'] : '';
            }
            if (isset($args['password'])) {
                $user->password = $args['password'] != '.' ? $args['password'] : '';
            }
            if (isset($args['avatar'])) {
                $user->avatar = $args['avatar'] != '.' ? $args['avatar'] : '';
            }
            if (isset($args['nickname'])) {
                $user->nickname = $args['nickname'] != '.' ? $args['nickname'] : '';
            }
            if (isset($args['delete'])) {
                $user->delete();
                Perfil::where('user_id', $user->id)->delete();

                return $user;
            }

            $perfil = Perfil::where('usuario_id', $user->id)->first();

            if ($perfil){
                $perfil->nombres = isset($args['perfil_nombres']) && $args['perfil_nombres'] != '.' ?  $args['perfil_nombres'] : null;
                $perfil->apellidos = isset($args['perfil_apellidos']) && $args['perfil_apellidos'] != '.' ?  $args['perfil_apellidos'] : null;
                $perfil->fecha = isset($args['perfil_fecha']) && $args['perfil_fecha'] != '.' ?  $args['perfil_fecha'] : null;
                $perfil->cargo = isset($args['perfil_cargo']) && $args['perfil_cargo'] != '.' ?  $args['perfil_cargo'] : null;
                $perfil->empresa = isset($args['perfil_empresa']) && $args['perfil_empresa'] != '.' ?  $args['perfil_empresa'] : null;
                $perfil->telefono = isset($args['perfil_telefono']) && $args['perfil_telefono'] != '.' ?  $args['perfil_telefono'] : null;
            }else{
                /*Retornar error*/
            }

            $perfil->save();
            $user->save();            
        } else {
            $user = User::create([
                'name' => isset($args['name']) && $args['name'] != '.' ?  $args['name'] : null,
                'email' => isset($args['email']) && $args['email'] != '.' ?  $args['email'] : null,
                'password' => isset($args['password']) && $args['password'] != '.' ?  bcrypt($args['password']) : null,
                'avatar' => isset($args['avatar']) && $args['avatar'] != '.' ?  $args['avatar'] : null,
                'nickname' => isset($args['nickname']) && $args['nickname'] != '.' ?  $args['nickname'] : null,
                'role_id' => isset($args['role_id']) && $args['role_id'] != '.' ?  $args['role_id'] : null
            ]);

            $perfil = Perfil::create([
                'usuario_id' => $user->id,
                'nombres' => isset($args['perfil_nombres']) && $args['perfil_nombres'] != '.' ?  $args['perfil_nombres'] : null,
                'apellidos' => isset($args['perfil_apellidos']) && $args['perfil_apellidos'] != '.' ?  $args['perfil_apellidos'] : null,
                'fecha' => isset($args['perfil_fecha']) && $args['perfil_fecha'] != '.' ?  $args['perfil_fecha'] : null,
                'cargo' => isset($args['perfil_cargo']) && $args['perfil_cargo'] != '.' ?  $args['perfil_cargo'] : null,
                'empresa' => isset($args['perfil_empresa']) && $args['perfil_empresa'] != '.' ?  $args['perfil_empresa'] : null,
                'telefono' => isset($args['perfil_telefono']) && $args['perfil_telefono'] != '.' ?  $args['perfil_telefono'] : null,
            ]);
        }

        return $user;
    }
}