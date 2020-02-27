<?php

namespace App\Http\Controllers;

use App\Sub_rota;
use App\Cidade;
use App\Rotas;
use Illuminate\Http\Request;

class SubRotaController extends Controller
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
        return view('sub_rotas/index', ['rotas' => $rotas]);

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
        return view('sub_rotas/create', [
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
    public function store($id)
    {

         $sub_rota_1 = new Sub_rota();
         $sub_rota_2 = new Sub_rota();
         $cidade = Cidade::findorfail($id);
         $rota = Rotas::findorfail($cidade->id_rota);
         $sub_rota_1->fill([
            'id_rotas' => $cidade->id_rota,
            'id_cidade1' => 0,
            'id_cidade2' => $cidade->id,
            'origem' => $rota->origem,
            'destino' =>$cidade->cidade,
            'hora_saida' => $rota->hora_de_saida,
            'duracao_minutos' => intval($cidade->hora_de_saida) - intval($rota->hora_de_saida)
         ]);
         $sub_rota_2->fill([
            'id_rotas' => $cidade->id_rota,
            'id_cidade1' => $cidade->id,
            'id_cidade2' => 0,
            'origem' => $cidade->cidade,
            'destino' =>$rota->destino,
            'hora_saida' => $cidade->hora_de_saida,
            'duracao_minutos' => (intval($rota->hora_de_saida) + intval($rota->duracao_minutos)) - intval($cidade->hora_de_saida) 
         ]);
         $sub_rota_1->save();
         $sub_rota_2->save();
         $cidades = Cidade::where('id_rota',$cidade->id_rota)->get();
         foreach ($cidades as $item) {
             if($item->id != $cidade->id) {
                $sub_rota = new Sub_rota();
                if($item->hora_de_saida > $cidade->hora_de_saida) {
                    $sub_rota->fill([
                        'id_rotas' => $cidade->id_rota,
                        'id_cidade1' => $cidade->id,
                        'id_cidade2' => $item->id,
                        'origem' => $cidade->cidade,
                        'destino' =>$item->cidade,
                        'hora_saida' => $cidade->hora_de_saida,
                        'duracao_minutos' => intval($item->hora_de_saida) - intval($cidade->hora_de_saida)
                    ]);
                }
                else {
                    $sub_rota->fill([
                        'id_rotas' => $cidade->id_rota,
                        'id_cidade1' => $item->id,
                        'id_cidade2' => $cidade->id,
                        'origem' => $item->cidade,
                        'destino' =>$cidade->cidade,
                        'hora_saida' => $item->hora_de_saida,
                        'duracao_minutos' => intval($cidade->hora_de_saida) - intval($item->hora_de_saida)
                    ]);
                }
                $sub_rota->save();
             }
         }
         return redirect()->route('rota.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sub_rota  $sub_rota
     * @return \Illuminate\Http\Response
     */
    public function show(Sub_rota $sub_rota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sub_rota  $sub_rota
     * @return \Illuminate\Http\Response
     */
    public function edit(Sub_rota $sub_rota)
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
        return view('sub_rotas/create', [
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sub_rota  $sub_rota
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $cidade = Cidade::findorfail($id);
        $rota = Rotas::findorfail($cidade->id_rota);
        $origem = Sub_rota::where('id_cidade1',0)->first();
        $destino = Sub_rota::where('id_cidade2',0)->first();
        $origem->update([
            'destino' =>$cidade->cidade,
            'duracao_minutos' => intval($cidade->hora_de_saida) - intval($rota->hora_de_saida)
        ]);
        $destino->update([
            'origem' =>$cidade->cidade,
            'hora_saida' => $cidade->hora_de_saida,
            'duracao_minutos' => (intval($rota->hora_de_saida) + intval($rota->duracao_minutos)) - intval($cidade->hora_de_saida) 
        ]);
        $origem->save();
        $destino->save();


        $sub_rotas1 = Sub_rota::where('id_cidade1',$id)->where('id_cidade2','>',0)->get();
        $sub_rotas2 = Sub_rota::where('id_cidade2',$id)->where('id_cidade1','>',0)->get();
        
        foreach($sub_rotas1 as $item) {
            $cidade2 = Cidade::findorfail($item->id_cidade2);
            if($cidade->hora_de_saida>$cidade2->hora_de_saida) {
                $item->update([
                        'id_cidade1' => $cidade2->id,
                        'id_cidade2' => $cidade->id,
                        'origem' => $cidade2->cidade,
                        'destino' =>$cidade->cidade,
                        'hora_saida' => $cidade2->hora_de_saida,
                        'duracao_minutos' => intval($cidade->hora_de_saida) - intval($cidade2->hora_de_saida)
                    ]);
            }
            else {
                $item->update([
                        'origem' => $cidade->cidade,
                        'hora_saida' => $cidade->hora_de_saida,
                        'duracao_minutos' => intval($cidade2->hora_de_saida) - intval($cidade->hora_de_saida)
                    ]);

            }
            $item->save();
        }
        foreach($sub_rotas2 as $item) {
            $cidade2 = Cidade::findorfail($item->id_cidade1);
            if($cidade->hora_de_saida < $cidade2->hora_de_saida) {
                 $item->update([
                        'id_cidade1' => $cidade->id,
                        'id_cidade2' => $cidade2->id,
                        'origem' => $cidade->cidade,
                        'destino' =>$cidade2->cidade,
                        'hora_saida' => $cidade->hora_de_saida,
                        'duracao_minutos' => intval($cidade2->hora_de_saida) - intval($cidade->hora_de_saida)
                    ]);
            }
            else {
                $item->update([
                        'destino' =>$cidade->cidade,
                        'duracao_minutos' => intval($cidade->hora_de_saida) - intval($cidade2->hora_de_saida)
                    ]);
            }
            $item->save();
        }
        
        return redirect()->route('rota.show', ['id' => $cidade->id_rota]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sub_rota  $sub_rota
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
