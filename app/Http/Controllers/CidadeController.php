<?php

namespace App\Http\Controllers;

use App\Cidade;
use App\Sub_rota;
use App\Rotas;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
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
        if($horas+$duracao_horas >= 24) {
            $duracao_dias++;
        }
        return view('cidades/create', [
            'rota' => $rota, 
            'duracao_dias' => $duracao_dias,
            'duracao_horas' => $duracao_horas,
            'duracao_minutos' => $duracao_minutos,
            'horas' => $horas,
            'minutos' => $minutos,
            'tempoinicial' => $rota->hora_de_saida
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cidade = new Cidade();
        $cidade->id_rota = $request->id_rotas;
        $cidade->cidade = $request->origem;
        $cidade->hora_de_saida = intval($request->saida_hora)*60 + intval($request->saida_minutos)  + intval($request->saida_dias)*60*24;
        $cidade->save();
        return redirect()->route('sub_rota.store', ['id' => $cidade->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cidade  $cidade
     * @return \Illuminate\Http\Response
     */
    public function show(Cidade $cidade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cidade  $cidade
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cidade = Cidade::findorfail($id);
        $rota = Rotas::findorfail($cidade->id_rota);
        $tempo = $rota->duracao_minutos;
        $duracao_minutos = $tempo%60;
        $tempo = intval($tempo/60);
        $duracao_horas = $tempo%24;
        $duracao_dias = intval($tempo/24); 
        $tempo = $rota->hora_de_saida;
        $minutos = $tempo%60;
        $horas = intval($tempo/60); 
        $cidade = Cidade::findorfail($id);
        $horas_subrota =  intval($cidade->hora_de_saida/60);
        $minutos_subrota =  $cidade->hora_de_saida%60;
        if($horas+$duracao_horas >= 24) {
            $duracao_dias++;
        }
        return view('cidades/edit', [
            'rota' => $rota, 
            'duracao_dias' => $duracao_dias,
            'duracao_horas' => $duracao_horas,
            'duracao_minutos' => $duracao_minutos,
            'horas' => $horas,
            'minutos' => $minutos,
            'tempoinicial' => $rota->hora_de_saida,
            'cidade' => $cidade,
            'horas_subrota' => $horas_subrota,
            'minutos_subrota' => $minutos_subrota
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cidade  $cidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cidade = Cidade::findorfail($id);
        $cidade->cidade = $request->origem;
        $cidade->hora_de_saida = intval($request->saida_hora)*60 + intval($request->saida_minutos) + intval($request->saida_dias)*60*24;
        $cidade->save();
        return redirect()->route('sub_rota.update', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cidade  $cidade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cidade = Cidade::findorfail($id);
        $sub_rotas = Sub_rota::where('id_cidade1',$id);
        foreach ($sub_rotas as $item) {
            $item->delete();
        }
        $sub_rotas = Sub_rota::where('id_cidade2',$id);
        foreach ($sub_rotas as $item) {
            $item->delete();
        }
        $cidade->delete();
    }
}
