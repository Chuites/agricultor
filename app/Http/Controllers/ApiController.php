<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\baseModel;
use Session;
use View;
use DB;

class ApiController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function testapi(Request $request){
        $test = Http::post('https://beneficiodecafeapirest.herokuapp.com/api/categoria');
        Logger("Estado: ". $test->status());
        Logger("Consulta: ". $test->body());

        return response()->json($test->body());
    }
}
