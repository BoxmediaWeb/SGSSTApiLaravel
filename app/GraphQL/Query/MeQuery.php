<?php

namespace App\GraphQL\Query;

use Closure;
use App\Models\User;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Illuminate\Support\Facades\Auth;

class MeQuery extends Query
{
    protected $attributes = [
        'name' => 'me',
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('user'))));
    }

    public function args(): array
    {
        return [
            'company_id' => ['name' => 'company_id', 'type' => Type::id()],
            'id' => ['name' => 'id', 'type' => Type::int()],
            'search' => ['name' => 'search', 'type' => Type::string()]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        // dd('console.log');
        if(isset($args['id'])){
            
            $user = User::where('id', $args['id'])->first();
            
            return $user;
        
        }else{

            // return auth('api')->user();
            return Auth::user();
        }
    }

    private function generateCode()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
