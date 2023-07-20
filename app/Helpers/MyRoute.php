<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;

class MyRoute extends Route
{
    public static function resourceWEB($name, $cls, $names = null, $only = null)
    {
        $route = self::resource($name, $cls);

        $route->parameters([$name => 'id']);

        if ($names) {
            $route->names('web.' . $names);
        }

        if ($only) {
            $route->only($only);
        }

        return $route;
    }

    public static function resourceAPI($name, $cls, $names = null, $only = null)
    {
        $route = self::apiResource($name, $cls);

        $route->parameters([$name => 'id']);

        if ($names) {
            $route->names('api.' . $names);
        }

        if ($only) {
            $route->only($only);
        }

        return $route;
    }
}
