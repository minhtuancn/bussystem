@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <nav class="nav flex-column bg-info">
              <center>
                  <a class="nav-link text-white" href="/home/">Home</a>
                  <a class="nav-link text-white" href="{{route('onibus.index')}}">Cadastrar Ônibus</a>
                  <a class="nav-link text-white" href="{{route('rota.index')}}">Consultar Rotas</a>
                  <a class="nav-link text-white" href="/home/register">Cadastrar Usuário</a>
                  <a class="nav-link text-white" href="/home/users">Gerenciar Usuários</a>
                  <a class="nav-link text-white" href="/">Página Inicial</a>
              </center>
            </nav>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Logado na conta de {{ Auth::user()->name }} 
                </div>
            </div>
            @yield('conteudo')
        </div>
    </div>
</div>

@endsection
