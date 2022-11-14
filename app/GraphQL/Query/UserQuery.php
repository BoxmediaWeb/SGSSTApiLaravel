<?php

namespace App\GraphQL\Query;

use Closure;
use App\Models\User;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class UserQuery extends Query
{
    protected $attributes = [
        'name' => 'The Project Query',
        'description' => 'Retrieves projects'
    ];

    private $jwt;


    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }


    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
      try {
          $this->auth =$this->jwt->parseToken()->authenticate();
      } catch (\Exception $e) {
          $this->auth = null;
      }
      return (boolean) $this->auth;
    }

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('user'));
    }

    public function args(): array
    {
        return [
            'search' => ['name' => 'search', 'type' => Type::string()],
            'id' => ['name' => 'id', 'type' => Type::int()],
        ];
    }

    public function resolve($root, $args)
    {
        $user = User::query();

        if(isset($args['id']) && $args['id'] !== '.') {
            $user=$user->where('id', $args['id']);
        }

        return $user->get();
    }
}