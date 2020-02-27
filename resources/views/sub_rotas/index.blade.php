@extends('home')
@section('conteudo')
<div class="container">
	<div class="row">
		<div class="col-12">
			<form method="post" action="{{route('sub_rota.create')}}">
				@csrf
				<div class="form-row">
					<div class="form-group">
						<label>Escolha a rota:</label>
						<select type="text" name="rota" id="rota">
							@foreach($rotas as $rota)
							<option id="{{$rota->id}}" time="{{$rota->hora_de_saida}}" name="rotas" value="{{$rota->id}}">{{$rota->origem}} - {{$rota->destino}} 
							</option>
							@endforeach
						</select>
					</div>
				</div>
				<button type="submit" class="btn btn-primary">SELECIONAR</button>
			</form>
		</div>
	</div>
</div>
@endsection




@section('script')
<script>
start();
function start() {
	elements = document.getElementsByName('rotas');
	for(i=0;i<elements.length;i++) {
		var tempo = elements[i].getAttribute('time');
		var horas = parseInt(parseInt(tempo)/60);
    	var minutos = parseInt(tempo)%60;	
    	if (minutos < 10) {
    		minutos = '0'+minutos;
    	}
    	if (horas < 10) {
    		horas = '0' + horas;
    	}
		elements[i].innerHTML += '(' + horas + ':' + minutos +')';
	}
}
</script>
@endsection