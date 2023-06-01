<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\baseModel;
use Session;
use View;
use DB;
use PDF;
use Dompdf\Options;

use GuzzleHttp;

class ApiController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function logout(Request $request){
        Session::forget('token');
        return response()->json(200);
    }

    public function borrarSesion(Request $request){
        Session::forget('token');
        return;
    }

    public function generarQR(Request $request, $id_cargamento){
        QrCode::generate(route('infoParcialidad', encrypt($id_cargamento)), '../public/qrcodes/qrcode.svg');

        $pdf = PDF::loadView('pdf.boletaQR');
        return $pdf->stream('Informació de Envio.pdf');
    }

    public function infoParcialidad(Request $request, $id_cargamento)
    {
        $request->id_cargamento = decrypt($id_cargamento);
        $data = [
            'id_cargamento' => $request->id_cargamento,
        ];
        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://beneficiodecafeapirest.herokuapp.com/api/infoParcialidad', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. Session::get('token')
            ],
            'json' => $data
        ]);
        if($response->getStatusCode() == 200)
        {
            $content = $response->getBody()->getContents();
            $data = json_decode($content, true);

            $dpi_piloto = $data['dpi'];
            $nombre_piloto = $data['nombre_completo'];
            $estado_piloto = $data['justificacion'];
            $placa_transporte = $data['placa'];
            $marca_transporte = $data['marca'];
            $color_transporte = $data['color'];
            $estado_transporte = $data['justificacion2'];

            return view('informacionParcialidad', compact('dpi_piloto', 'nombre_piloto', 'estado_piloto', 'placa_transporte', 'marca_transporte', 'color_transporte', 'estado_transporte'));
        }
        else {
            $data = [
                'mensaje' => 'Error al consultar los cargamentos'
            ];
            return response()->json($data, 401);
        }
    }


    public function enviarParcialidad(Request $request){
        $data = [
            'id_cargamento' => $request->id_cargamento,
            'peso_parcialidad' => $request->peso_parcialidad
        ];
        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://beneficiodecafeapirest.herokuapp.com/api/recibirParcialidad', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. Session::get('token')
            ],
            'json' => $data
        ]);
        if($response->getStatusCode() == 200)
        {
            $content = $response->getBody()->getContents();
            $data = json_decode($content, true);

            return response()->json($data, 200);
        }
        else {
            $data = [
                'mensaje' => 'Error al consultar los cargamentos'
            ];
            return response()->json($data, 401);
        }
    }

    public function listadoCargamentos(Request $request){
        $data = [
            'id_cuenta' => Session::get('id_cuenta')
        ];
        $client = new \GuzzleHttp\Client();
        //$response = $client->post('http://beneficiodecafeapirest.herokuapp.com/api/listadoCargamentos', [
        $response = $client->post('https://beneficiodecafeapirest.herokuapp.com/api/listadoCargamentos', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. Session::get('token')
            ],
            'json' => $data
        ]);
        if($response->getStatusCode() == 200)
        {
            $content = $response->getBody()->getContents();
            $data = json_decode($content, true);

            return response()->json($data, 200);
        }
        else {
            $data = [
                'mensaje' => 'Error al consultar los cargamentos'
            ];
            return response()->json(401);
        }
    }

    public function testapi(Request $request){
        $client = new \GuzzleHttp\Client();
        //$response = $client->post('http://beneficiodecafeapirest.herokuapp.com/api/testConectividad', [
        $response = $client->post('https://beneficiodecafeapirest.herokuapp.com/api/testConectividad', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. Session::get('token')
            ],
            'json' => ''
        ]);
        $content = $response->getBody()->getContents();
        $data = json_decode($content, true);
        return response()->json($data);
    }

    public function login(Request $request){
        $data = [
            'email' => $request->username,
            'password' => $request->password
        ];
        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://beneficiodecafeapirest.herokuapp.com/api/login', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
            'json' => $data
        ]);
        if($response->getStatusCode() == 200)
        {
            $content = $response->getBody()->getContents();
            $data = json_decode($content, true);
            Session::put('token', $data['token']);
            Session::put('id_cuenta', $data['id']);

            return response()->json(200);
        }
        else {
            return response()->json(401);
        }
    }

    public function welcome(){
        if (Session::has('token')) {
            return view('welcome');
        }else{
            return view('login/login');
        }
    }

    public function testTransporte(Request $request){
        $validator = Validator::make($request->all(), [
            'placa' => 'required|regex:/^[A-Z]{1}\d{3}[A-Z]{3}$/',
        ],
        [
            //Mensajes a mostrar
            'placa.required' => 'Es requerida la placa',
            'placa.regex' => 'Debe ingresar un formato de placa valido'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->all());
        }else{
            $data = [
                'placa' => $request->placa
            ];
            $client = new \GuzzleHttp\Client();
            //$response = $client->post('http://beneficiodecafeapirest.herokuapp.com/api/confirmarTransporte', [
            $response = $client->post('https://beneficiodecafeapirest.herokuapp.com/api/confirmarTransporte', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '. Session::get('token')
                ],
                'json' => $data
            ]);
            $content = $response->getBody()->getContents();
            $estado = $response->getStatusCode();
            $data = json_decode($content, true);

            return response()->json($data);
        }
    }

    public function testPiloto(Request $request){
        $validator = Validator::make($request->all(), [
            'dpi_piloto' => 'required|numeric|digits:13',
        ],
        [
            //Mensajes a mostrar
            'dpi_piloto.required' => 'Es requerida un numero de DPI',
            'dpi_piloto.digits' => 'El DPI debe contener 13 digitos'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->all());
        }else{
            $data = [
                'dpi' => $request->dpi_piloto
            ];
            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://beneficiodecafeapirest.herokuapp.com/api/confirmarPiloto', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '. Session::get('token')
                ],
                'json' => $data
            ]);
            $content = $response->getBody()->getContents();
            $estado = $response->getStatusCode();
            $data = json_decode($content, true);
            return response()->json($data);
        }
    }

    public function crearCuenta(Request $request){
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required|numeric|digits:8',
            'dpi' => 'required|numeric|digits:13',
            'nit' => 'required|numeric|digits:8',
            'correo' => 'required|email'
        ],
        [
            //Mensajes a mostrar
            'nombre.required' => 'Es requerida la informacion de nombre',
            'direccion.required' => 'Es requerida la informacion de direccion',
            'telefono.required' => 'Es requerida la informacion de telefono',
            'telefono.digits' => 'El telefono debe tener 8 digitos',
            'dpi.required' => 'Es requerida la informacion de dpi',
            'dpi.digits' => 'El DPI debe contener 13 digitos',
            'nit.required' => 'Es requerida la informacion de nit',
            'nit.digits' => 'El nit debe tener 8 digitos',
            'correo.required' => 'Es requerida la direccion de correo',
            'correo.email' => 'Formato de correo no valido',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->all());
        }else{
            $request;
            $data = [
                'name' => $request->nombre,
                'email' => $request->correo,
                'password' => $request->password,
                'dpi' => $request->dpi,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'nit' => $request->nit
            ];
            $client = new \GuzzleHttp\Client();
            //$response = $client->post('http://beneficiodecafeapirest.herokuapp.com/api/crearCuenta', [
            $response = $client->post('https://beneficiodecafeapirest.herokuapp.com/api/crearCuenta', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '. Session::get('token')
                ],
                'json' => $data
            ]);
            $content = $response->getBody()->getContents();
            $data = json_decode($content, true);
            return response()->json($data);
        }
    }

    public function estadoCargamento(Request $request){
        $data = [
            'id_cargamento' => $request->id_cargamento
        ];
        $client = new \GuzzleHttp\Client();
        try {
            //$response = $client->post('http://beneficiodecafeapirest.herokuapp.com/api/estadoCargamento', [
            $response = $client->post('https://beneficiodecafeapirest.herokuapp.com/api/estadoCargamento', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '. Session::get('token')
                ],
                'json' => $data
            ]);
            $content = $response->getBody()->getContents();
            $data = json_decode($content, true);
            return response()->json($data);

        } catch (ClientException $e) {
            if ($e->getResponse()->getStatusCode() === 400) {
                return response()->json($data);
            } else {
                return response()->json($data);
            }
        }
    }

    public function enviarCargamento(Request $request){
        $validator = Validator::make($request->all(), [
            'dpi_piloto' => 'required',
            'placa_transporte_envio' => 'required',
            'peso_total' => 'required|numeric',
            'parcialidades' => 'required|numeric',
        ],
        [
            //Mensajes a mostrar
            'dpi_piloto.required' => 'Es requerida la informacion del dpi del piloto',
            'placa_transporte_envio.required' => 'Es requerida la informacion de la placa del transporte',
            'peso_total.required' => 'Es requerida la informacion de peso total',
            'peso_total.numeric' => 'El peso total debe ser un numero',
            'parcialidades.required' => 'Es requerida la informacion de parcialidades',
            'parcialidades.numeric' => 'Parcialidades debe ser un numero',
            'id_cuenta.required' => 'Es requerida la informacion de el numero de cuenta'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->all());
        }else{
            $data = [
                'dpi_piloto' => $request->dpi_piloto,
                'placa_transporte' => $request->placa_transporte_envio,
                'peso_total' => $request->peso_total,
                'parcialidades' => $request->parcialidades,
                'id_cuenta' => Session::get('id_cuenta'),
            ];
            $client = new \GuzzleHttp\Client();
            try {
                //$response = $client->post('http://beneficiodecafeapirest.herokuapp.com/api/envioCargamento', [
                $response = $client->post('https://beneficiodecafeapirest.herokuapp.com/api/envioCargamento', [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '. Session::get('token')
                    ],
                    'json' => $data
                ]);

                $content = $response->getBody()->getContents();
                $data = json_decode($content, true);
                return response()->json($data);

            } catch (ClientException $e) {
                if ($e->getResponse()->getStatusCode() === 400) {
                    return response()->json($data);
                } else {
                    return response()->json($data);
                }
            }

        }
    }
}
