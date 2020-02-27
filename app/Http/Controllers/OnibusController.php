<?php

namespace App\Http\Controllers;

use App\Onibus;
use Illuminate\Http\Request;

class OnibusController extends Controller
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
        $buses = Onibus::all();
        return view('onibus/index', ['buses' => $buses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('onibus/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bus = new Onibus;
        $placas = Onibus::where('placa', $request->placa)->get();
        if(empty($placas[0])){
            $bus->marca = $request->marca;
            $bus->placa = $request->placa;
            $bus->lugares = $request->lugares;
            $bus->save();   
             echo "<script>alert('Ônibus cadastrado com sucesso')</script><meta http-equiv='refresh' content='0; url=/home'>";
         }  
        else {
            return redirect()->route('onibus.create')->with("message", "Já existe um usuário com esse email já cadastrado");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Onibus  $onibus
     * @return \Illuminate\Http\Response
     */
    public function show(Onibus $onibus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Onibus  $onibus
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $bus = Onibus::findorfail($id);
        return view('onibus/edit', ['bus' => $bus]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Onibus  $onibus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bus = Onibus::findorfail($id);
        $placas = Onibus::where('placa', $request->placa)->get();
        if((empty($placas[0])) || ($placas[0]->placa===$bus->placa)){
            $bus->fill([
                'marca' => $request->marca,
                'placa' => $request->placa,
                'lugares' => $request->lugares
            ]);
            $bus->save();
        }
        else {
            return redirect()->route('onibus.edit', ['id' => $id])->with("message", "Já existe um outro ônibus cadastrado com essa placa");
        }
        return redirect()->route('onibus.index')->with("message-success","Ônibus atualizado com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Onibus  $onibus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bus = Onibus::findorfail($id);
        $bus->delete();
        return redirect()->route('onibus.index');
    }
}
