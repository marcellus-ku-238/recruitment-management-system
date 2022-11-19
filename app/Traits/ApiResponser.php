<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;

trait ApiResponser
{
    public function success($data, $code = 200)
    {
        return response()->json($data, $code);
    }

    public function error($data, $code = 400)
    {
        return response()->json($data, $code);
    }
}