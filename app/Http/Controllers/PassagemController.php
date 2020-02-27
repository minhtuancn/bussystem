<?php

namespace App\Http\Controllers;

use App\Passagem;
use App\Rotas;
use App\Sub_rota;
use Illuminate\Http\Request;

class PassagemController extends Controller
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
    public function create(Request $request)
    {
        if($request->id_rota!=null) {

            $rota = Rotas::findorfail($request->id_rota);
            $id = $rota->id;
            $subrota_id = 0;
            $subrotas = Sub_rota::where('id_rotas',$request->id)->get();
        }
        else {
             $sub_rota = Sub_rota::findorfail($request->id_subrota);
             $rota = Rotas::findorfail($sub_rota->id_rotas);
             $id = $rota->id;
             $subrota_id = $sub_rota->id;
             $subrotas = Sub_rota::where('id_rotas',$rota->id)->get();
             foreach ($subrotas as $key => $item) {
                 if($sub_rota->hora_saida + $sub_rota->duracao_minutos < $item->hora_saida) {
                    unset($subrotas[$key]);
                 }
             }
        }
        
        $passagens = Passagem::where('id_rota', $rota->id)->where('dia',$request->date)->get();
        foreach ($subrotas as $item) {
            $passagem = Passagem::where('id_sub_rota',$item->id)->where('dia',$request->date)->first();
            if($passagem!=null) {
                $passagens->add($passagem);
            }
            
        }
        $assentos = array();
        foreach ($passagens as $passagem) {
            array_push($assentos, $passagem->assento);
        }
        return view('passagens/create', [
            'assentos' => $assentos,
            'lugares' => $rota->lugares,
            'date' => $request->date,
            'id' => $id,
            'subrota_id' => $subrota_id 
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
        $passagem = new Passagem();
        for($i=1;$i<=intval($request->lugares);$i++) {
            $val = 'a'.$i;
            if($request->$val !=null) {
                $passagem->fill([
                    'dia' => $request->dia,
                    'nome' => $request->nome,
                    'id_rota' => $request->id_rota,
                    'id_sub_rota' => $request->id_sub_rota,
                    'assento' => $i
                ]);
                break;
            }
        }
        $passagem->save();
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Passagem  $passagem
     * @return \Illuminate\Http\Response
     */
    public function show(Passagem $passagem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Passagem  $passagem
     * @return \Illuminate\Http\Response
     */
    public function edit(Passagem $passagem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Passagem  $passagem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Passagem $passagem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Passagem  $passagem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Passagem $passagem)
    {
        //
    }
}
