@extends('home')
@section('conteudo')
<div class="container">
	<div class="row">
		<div class="col-12">
			@if (session('message'))
	          <div class="alert alert-danger">
	            {{ session('message') }}
	          </div>
       		 @endif
			<form autocomplete="off" method="post" action=" {{route('rota.store')}}">
				@csrf
				<div class="form-row">
					<div class="form-group col-md-5">
						<label>Origem</label>
						<input class="form-control" id="origem" type="text" name="origem"  required>
					</div>
					<div class="form-group col-md-5">
						<label>Destino</label>
						<input class="form-control "  type="text" name="destino" id="destino" required>
					</div>
					<div class="form-group col-md-2">
								<label>Lugares</label>
								<select name="lugares" type="number" class="form-control" required>
									@for($i=1;$i<=50;$i++)
										<option value = "{{$i}}"> {{$i}}</option>
									@endfor
								</select>
					</div>
				</div>
				<div class="form-row">
					<div class="col-lg-6 col-md-12">
						<div class="row">
							<div class="form-group col-6">
								<label>Hora da Saída</label>
								<select type="number" class="form-control" id="saida_hora" name="saida_hora" placeholder="Hora" required>
		              			</select>
							</div>
							<div class="form-group col-6">
								<label>Minutos</label>
								<select type="number" class="form-control" id="saida_minutos" placeholder="Minutos" name="saida_minutos" required>
		            			
		              			</select>
							</div>
							
						</div>
					</div>
					<div class="col-lg-6 col-md-12">
						<div class="row">
							<div class="form-group col-lg-6 col-md-8">
								<label>Duração da Viagem - Dias</label>
								<select type="number" class="form-control" id="duracao_dias" name="duracao_dias" placeholder="Hora" required>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
							</div>
							<div class="form-group col-lg-3 col-md-2">
								<label>Horas</label>
								<select type="number" class="form-control" id="duracao_horas" name="duracao_horas" placeholder="Hora" required>
		              			</select>
							</div>
							<div class="form-group col-lg-3 col-md-2">
								<label>Minutos</label>
								<select type="number" class="form-control" id="duracao_minutos" placeholder="Minutos" name="duracao_minutos" required>
		              			</select>
							</div>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group mr-4">
						<label>Selecionar Todos</label>
						<input type="checkbox" onClick="toggle(this)" />
					</div>
					
					<div class="form-group mr-4">
						<label for="domingo" >Domingo</label>
						<input class="dias" type="checkbox" name="domingo">
					</div>
					<div class="form-group mr-4">
						<label for="segunda" >Segunda</label>
						<input class="dias" type="checkbox" name="segunda">
					</div>
					<div class="form-group mr-4">
						<label for="terca" >Terça</label>
						<input class="dias" type="checkbox" name="terca">
					</div>
					<div class="form-group mr-4">
						<label for="quarta" >Quarta</label>
						<input class="dias" type="checkbox" name="quarta">
					</div>
					<div class="form-group mr-4">
						<label for="quinta" >Quinta</label>
						<input class="dias" type="checkbox" name="quinta">
					</div>
					<div class="form-group mr-4">
						<label for="sexta" >Sexta</label>
						<input class="dias" type="checkbox" name="sexta">
					</div>
					<div class="form-group mr-4">
						<label for="sabado" >Sábado</label>
						<input class="dias" type="checkbox" name="sabado">
					</div>
				</div>
				<button onclick="validatePassword('origem'), validatePassword('destino')"type="submit" class="btn btn-primary">Salvar</button>
			</form>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
var cidades = []
var origem = document.getElementById('origem');
var destino = document.getElementById('destino');
var ok=0;
var times = 0;
var id=0;
setTime('#saida_hora','#saida_minutos');
setTime('#duracao_horas','#duracao_minutos');
$(function() {
  $.getJSON('../../estados_cidades1.json', function (data) {
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
})
	
function validatePassword(campo) {
	var element = document.getElementById(campo);
	console.log(element.value);
		if(!(cidades.includes(element.value))) {
			element.setCustomValidity('Cidade não cadastrada');
		}
		else {
			element.setCustomValidity('');
		}
	}

function toggle(source) {
    checkboxes = document.getElementsByClassName('dias');
	for(var i=0, n=checkboxes.length;i<n;i++) {
    	checkboxes[i].checked = source.checked;
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







	
</script>
@endsection