<?php

namespace Domains\Secret\Controllers;

use Domains\Secret\Models\Secret;
use Illuminate\Http\Request;

class SecretController
{
    public function index()
    {
        $secrets = Secret::all();
        return response()->json($secrets);
    }
}
