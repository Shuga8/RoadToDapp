<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    use HttpResponses;
    public function testAuth()
    {
        return response()->json(['message' => 'authenticated']);
    }
}
