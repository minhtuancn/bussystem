<?php

namespace App\Http\Controllers;

use App\Rotas;
use App\Sub_rota;
use App\Onibus;
use App\Cidade;
use Illuminate\Http\Request;

class RotasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $rotas = Rotas::all();
        return view('rotas/index', ['rotas' => $rotas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $buses = Onibus::all();
        return view ('rotas/create', ['buses' => $buses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rota = new Rotas();
        $rota->origem = $request->origem;
        $rota->destino = $request->destino;
        $rota->hora_de_saida = intval($request->saida_hora)*60 + intval($request->saida_minutos);
        $rota->duracao_minutos = intval($request->duracao_dias)*24*60 + intval($request->duracao_horas)*60 + intval($request->duracao_minutos);
        $rota->domingo = $this->setDays($request->domingo);
        $rota->segunda = $this->setDays($request->segunda);
        $rota->terca = $this->setDays($request->terca);
        $rota->quarta = $this->setDays($request->quarta);
        $rota->quinta = $this->setDays($request->quinta);
        $rota->sexta = $this->setDays($request->sexta);
        $rota->sabado = $this->setDays($request->sabado);
        $rota->lugares = intval($request->lugares);
        $rota->save();
        return redirect()->route('rota.index');
    }

    public function setDays($dia_cliente) {
        if($dia_cliente != null) {
            $dia = 1;
        }
        else {
            $dia = 0;
        }
        return $dia;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rotas  $rotas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rota = Rotas::findorfail($id);
        $tempo = $rota->duracao_minutos;
        $duracao_minutos = $tempo%60;
        $tempo = intval($tempo/60);
        $duracao_horas = $tempo%24;
        $duracao_dias = intval($tempo/24); 
        $tempo = $rota->hora_de_saida;
        $minutos = $tempo%60;
        $horas = intval($tempo/60); 
        $paradas = Cidade::where('id_rota',$id)->get();
        if($horas+$duracao_horas >= 24) {
            $duracao_dias++;
        }
        return view('rotas/show', [
            'rota' => $rota, 
            'duracao_dias' => $duracao_dias,
            'duracao_horas' => $duracao_horas,
            'duracao_minutos' => $duracao_minutos,
            'horas' => $horas,
            'minutos' => $minutos,
            'tempoinicial' => $rota->hora_de_saida,
            'paradas' => $paradas
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rotas  $rotas
     * @return \Illuminate\Http\Response
     */
    public function edit(Rotas $rotas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rotas  $rotas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd($request->hora);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rotas  $rotas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rota = Rotas::findorfail($id);
        $sub_rotas = Sub_rota::where('id_rotas',$id)->get();
        $cidades = Cidade::where('id_rota',$id)->get();
        foreach ($cidades as $item) {
            $item->delete();
        }
        foreach ($sub_rotas as $item) {
            $item->delete();
        }
        $rota->delete();
        return redirect()->route('rota.index');   
    }
}
