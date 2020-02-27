@extends('home')
@section('conteudo')
<div class="container">
	<div class="row">
		<div class="col-12">
			<h4>{{$rota->origem}} - 
		@if($minutos<10)
			{{$horas}}:0{{$minutos}}
		@else
			{{$horas}}:{{$minutos}}
		@endif
			
				à {{$rota->destino}} - Duração de 
				@if($duracao_dias == 0)
					0d
				@else
					{{$duracao_dias-1}}d
				@endif
				{{$duracao_horas}}hrs e {{$duracao_minutos}}min
			</h4>
		</div>
	</div>
	
		<div style="overflow-y: scroll; height: 350px" >
  			<ul id='list' class="col-12" style = "list-style: none;" id="paradas" >
  				@foreach($paradas as $parada)
  				<?php 
  				$tempo = $parada->hora_de_saida;
				$duracao_minutos = $tempo%60;
        		$tempo = intval($tempo/60);
        		$duracao_horas = $tempo%24;
        		$duracao_dias = intval($tempo/24); 
        		$duracao_dias++;
	 			?>
  				<div id="div{{$rota->id}}" class="row border p-3">
  					<div class="col-lg-10 col-md-9 col-sm-9 col-xs-2">
  						<li id="{{$parada->id}}"><a href="#" class="text-dark">{{$parada->cidade}} às 
  						@if($duracao_minutos<10)
							{{$duracao_horas}}:0{{$duracao_minutos}}
						@else
							{{$duracao_horas}}:{{$duracao_minutos}}
						@endif  do dia {{$duracao_dias}}</a></li>
  					</div>
  					<div class="col-lg-2 col-md-3 col-sm-3 col-xs-10">
              			<a href="{{route('cidades.edit', ['id' => $parada->id])}}"><i class="fas fa-user-edit mr-2"></i></a>
  						<a id="{{$parada->id}}" href="#" onclick = "modal({{$parada->id}})"data-url = "{{route('cidades.destroy', ['id' => $parada->id])}}" data-toggle="modal" data-target="#sure"><i class="fas fa-user-minus mr-2"></i></a>
  					</div>
  				</div>
  				@endforeach
  			</ul>
		</div>
</div>
@endsection