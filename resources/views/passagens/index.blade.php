@extends('layouts.cabecalho')
@section('content')
<div class="container my-3">
	<div class="row">
		<div class="col-12">
	
		@if(count($rotas) == 0 && count($sub_rotas)==0)
			<h4>Não há rotas disponíveis para este caminho</h4>
		@else
			<table class="table table-striped">
				<tr>
					<th>Origem</th>
					<th>Destino</th>
					<th>Horário de Saída</th>
					<th>Duração da viagem</th>
					<th>Ir</th>
				</tr>
				@foreach($rotas as $rota)
					
					<?php  
		  				$tempo = $rota->duracao_minutos;
						$duracao_minutos = $tempo%60;
		        		$tempo = intval($tempo/60);
		        		$duracao_horas = $tempo%24;
		        		$duracao_dias = intval($tempo/24); 
		        		$tempo = $rota->hora_de_saida;
		        		$minutos = $tempo%60;
		        		$horas = intval($tempo/60);
		        		if($minutos<10) {
		        			$minutos = '0'.$minutos; 
		        		}
		        		$now = time()-10800;
		        		$time = new DateTime($date.' '.$horas.':'.$minutos.':00');			
		 			?>

					<tr>
						<td>{{$rota->origem}}</td>
						<td>{{$rota->destino}}</td>
						<td>
							{{$horas}}:{{$minutos}}
						</td>
						<td>
							{{$duracao_dias}}d {{$duracao_horas}}hrs e {{$duracao_minutos}}min
						</td>
						<td>
							@if($time->getTimestamp() > $now+60)
								<form method="post" action="{{route('passagem.create')}}">
									@csrf
									<input type="hidden" name="id_rota" value="{{$rota->id}}">
									<input type="hidden" name="date" value="{{$date}}">
									<button style="border: none; background: none;" type="submit"><i class="fas fa-arrow-circle-right"></i></button>
								</form>
							@else
								<span>Reservas encerradas</span>
							@endif
						</td>
						
					</tr>
				@endforeach
				@foreach($sub_rotas as $sub_rota)
					<?php  
		  				$tempo = $sub_rota->duracao_minutos;
						$duracao_minutos = $tempo%60;
		        		$tempo = intval($tempo/60);
		        		$duracao_horas = $tempo%24;
		        		$duracao_dias = intval($tempo/24); 
		        		$tempo = $sub_rota->hora_saida;
		        		$minutos = $tempo%60;
		        		$horas = intval($tempo/60);
		        		while($horas>24) {
		        			$horas = $horas - 24;
		        		}
		        		if($minutos<10) {
		        			$minutos = '0'.$minutos; 
		        		}
		        		$now = time()-10800;
		        		$time = new DateTime($date.' '.$horas.':'.$minutos.':00');
		 			?>
					<tr>
						<td>{{$sub_rota->origem}}</td>
						<td>{{$sub_rota->destino}}</td>
						<td>
							{{$horas}}:{{$minutos}}
						</td>
						<td>
							{{$duracao_dias}}d {{$duracao_horas}}hrs e {{$duracao_minutos}}min
						</td>
						<td>
							@if($time->getTimestamp() > $now+60)
							<form method="post" action="{{route('passagem.create')}}">
								@csrf
								<input type="hidden" name="id_subrota" value="{{$sub_rota->id}}">
								<input type="hidden" name="date" value="{{$date}}">
								<button  style="border: none; background: none;" type="submit"><i class="fas fa-arrow-circle-right"></i></button>
							</form>
							@else
							<span>Reservas encerradas</span>
							@endif
						</td>
					</tr>
				@endforeach
			</table>
		@endif
		</div>
	</div>
</div>
@endsection