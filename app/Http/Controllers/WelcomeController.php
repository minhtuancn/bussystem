<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rotas;
use App\Sub_rota;
class WelcomeController extends Controller
{
    public function index() {
    	return view('welcome', [
    		'date' => date("d-m-Y")
    	]); 
    }
    public function search(Request $request) {
        $dias = array('domingo','segunda','terca','quarta','quinta','sexta','sabado');
        $dia = $dias[date('w', strtotime($request->date))];
    	$rotas = Rotas::where('origem',$request->origem)->where('destino',$request->destino)->where($dia,1)->get();
    	$sub_rotas = Sub_rota::where('origem',$request->origem)->where('destino',$request->destino)->get();
        foreach ($sub_rotas as $key => $item) {
            $rota = Rotas::findorfail($item->id_rotas);
            if($rota->$dia == 0) {
                unset($sub_rotas[$key]);
            }

        }
    	return view('passagens/index', [
            'rotas' => $rotas,
            'sub_rotas' => $sub_rotas,
            'date' => $request->date
        ]);
    }
}
