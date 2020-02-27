<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user/show_user', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user/new_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $emails = User::where('email', $request->email)->get();
        if(empty($emails[0])){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->senha);
            $user->save();   
             echo "<script>alert('Usuário cadastrado com sucesso')</script><meta http-equiv='refresh' content='0; url=/home'>";
         }  
        else {
            return redirect()->route('user.create')->with("message", "Já existe um usuário com esse email já cadastrado");
        }
            
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $user = User::find($id);
        return view('user/edit_user', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findorfail($id);
        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->senha)
        ]);
        $user->save();
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        if (count(User::all()) > 1) {
            $user = User::findorfail($id);
            if (Auth::user()->id != $user->id) {
                $user->delete();
                return redirect()->route('user.index');
            }
            else {
                return redirect()->route('user.index')->with("message", "Não pode-se remover o usuário atual");
            }
            
        }
        else {
            return redirect()->route('user.index')->with("message", "Deve-se deixar ao menos um usuário");
        }
        
    }
        
}
