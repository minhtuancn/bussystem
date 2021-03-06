@extends('home')
@section('conteudo')
<div class="container">
	<h4>Sub-rota da rota de {{$rota->origem}} à {{$rota->destino}}, com saída às 
		@if($minutos<10)
			{{$horas}}:0{{$minutos}}
		@else
			{{$horas}}:{{$minutos}}
		@endif
		 com duração de {{$duracao_dias-1}} dias, {{$duracao_horas}} horas e {{$duracao_minutos}} minutos
	</h4>
	<div class="row">
		<div class="col-12">
			<form method="post" action="{{route('sub_rota.store')}}" autocomplete="off">
				@csrf
				<input type="hidden" name="id_rotas" value="{{$rota->id}}">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label>Origem</label>
						<input class="form-control" id="origem" type="text" name="origem"  required>
					</div>
					<div class="form-group col-md-6">
						<label>Destino</label>
						<input class="form-control "  type="text" name="destino" id="destino" required>
					</div>
				</div>
				
				<div class="form-row">
					<div class="col-lg-6 col-md-12">
						<div class="row">
							<div class="form-group col-4">
								<label>Hora da Saída</label>
								<select  type="number" class="form-control" id="saida_hora" name="saida_hora" placeholder="Hora" required>
		              			</select>
							</div>
							<div class="form-group col-3">
								<label>Minutos</label>
								
								<select  type="number" class="form-control" id="saida_minutos" placeholder="Minutos" name="saida_minutos" required>
		            			
		              			</select>
							</div>
							<div class="form-group col-5">
								<label>Dia da parada</label>
								
								<select  type="number" class="form-control" id="saida_dias" placeholder="Minutos" name="saida_minutos" required>
		            				<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
		              			</select>
		              			<a class="btn btn-secondary" data-toggle="popover" data-placement="right" data-trigger="focus" tabindex="0" role="button" title="Dias" data-content="Prenche esse campo com o dia que acontece essa parada, se for no mesmo dia da saída de {{$rota->origem}}, preencha com 0, se for no dia seguinte, dia 1, e assim consequentemente.">Ajuda</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-12">
						<div class="row">
							<div class="form-group col-lg-6 col-md-8">
								<label>Duração da Viagem - Dias</label>
								<select  type="number" class="form-control" id="duracao_dias" name="duracao_dias" placeholder="Hora" required>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
								</select>
							</div>
							<div class="form-group col-lg-3 col-md-2">
								<label>Horas</label>
								<select  type="number" class="form-control" id="duracao_horas" name="duracao_horas" placeholder="Hora" required>
		              			</select>
							</div>
							<div class="form-group col-lg-3 col-md-2">
								<label>Minutos</label>
								<select  type="number" class="form-control" id="duracao_minutos" placeholder="Minutos" name="duracao_minutos" required>
		              			</select>
							</div>
						</div>
					</div>
				</div>
				<button>TESTE</button>
				<button onclick="validatePassword('origem'), validatePassword('destino'), verificaTempo({{$rota->hora_de_saida}}, {{$rota->duracao_minutos}}); "type="submit" class="btn btn-primary">Salvar</button>
			</form>
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
var cidades = [];
setTime('#saida_hora','#saida_minutos');
setTime('#duracao_horas','#duracao_minutos');
$(function() {
  $.getJSON('../../../estados_cidades1.json', function (data) {
    var cidade_estado = ''
    $.each(data, function (key, val) {
        $.each(val.cidades, function(key, cidade) {
             cidade_estado = cidade + ',' + val.sigla
             cidades.push(cidade_estado);
        });
    });
    autocomplete(document.getElementById("origem"), cidades);
    autocomplete(document.getElementById("destino"), cidades);
  });
});

function validatePassword(campo) {
	var element = document.getElementById(campo);
		if(!(cidades.includes(element.value))) {
			element.setCustomValidity('Cidade não cadastrada');
		}
		else {
			element.setCustomValidity('');
		}
	}

function setTime(id_hora, id_minutos) {

 	var option = '';
 	for(i=0; i<24;i++) {
 		if (i<10) {
 			option += '<option value = "0'+i+'"> 0'+i+'</option>';
 		}
 		else {
 			option += '<option value = "'+i+'">'+i+'</option>';
 		}
 		
 	}
 	$(id_hora).html(option);
 	option = ''
 	for(i=0; i<60;i++) {
 		if (i<10) {
 			option += '<option value = "0'+i+'"> 0'+i+'</option>';
 		}
 		else {
 			option += '<option value = "'+i+'">'+i+'</option>';
 		}
 		
 	}
 	$(id_minutos).html(option);


 	//$('#chegada_hora').html(option);


 }

 function verificaTempo (hora_de_saida, duracao) {
 	var horas= parseInt(document.getElementById('saida_hora').value);
 	var dias= parseInt(document.getElementById('saida_dias').value);
 	var minutos= parseInt(document.getElementById('saida_minutos').value);
 	var total = hora_de_saida + duracao;
 	if(dias > 0) {
 		var minutos_saida = horas*60 + minutos + 24*60;
 	}
 	else {
 		var minutos_saida = horas*60 + minutos;
 	}
 	console.log(minutos_saida)
 	console.log(hora_de_saida)
 	console.log(total)
 	var element = document.getElementById('saida_hora');
 	if((minutos_saida < hora_de_saida) || (minutos_saida > total)) {
 		
 		element.setCustomValidity('Horário da parada deve estar entre o horário da rota');
 		console.log('entrei')
 	}
 	else {
 		element.setCustomValidity('');
 	}
 	var horas= parseInt(document.getElementById('duracao_horas').value);
 	var dias= parseInt(document.getElementById('duracao_dias').value);
 	var minutos= parseInt(document.getElementById('duracao_minutos').value);
 	var total_rota = minutos_saida + (horas*60) + (dias*24*60) + minutos;
 	var element = document.getElementById('duracao_dias');
 	if(total_rota > total) {
 		
 		element.setCustomValidity('Tempo para chegar ao destino deve estar dentro do tempo da rota');
 	}
 	else {
 		element.setCustomValidity('');
 	}
 	
 }

 $(function () {
    $('[data-toggle="popover"]').popover();
  })

 





</script>
@endsection