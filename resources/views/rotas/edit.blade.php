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
			<form autocomplete="off" method="post" action=" {{route('rota.update')}}">
				@csrf
				<div class="form-row">
					<div class="form-group col-md-6">
						<label>Origem</label>
						<input value = "{{$rota->origem}}" class="form-control" id="origem" type="text" name="origem"  required>
					</div>
					<div class="form-group col-md-6">
						<label>Destino</label>
						<input class="form-control " value = "{{$rota->destino}}" type="text" name="destino" id="destino" required>
					</div>
				</div>
				<div class="form-row">
					<div class="col-lg-6 col-md-12">
						<div class="row">
							<div class="form-group col-6">
								<label>Hora da Saída</label>
								<select type="number" class="form-control" id="saida_hora" name="saida_hora" placeholder="Hora" required>
									@for($i=0;$i<24;$i++)
										@if($i==$hora_saida)
											@if($i<10)
											<option value="{{$i}}" selected>0{{$i}}</option>
											@else
											<option value="{{$i}}" selected>{{$i}}</option>
											@endif
										@else
											@if($i<10)
											<option value="{{$i}}" >0{{$i}}</option>
											@else
											<option value="{{$i}}">{{$i}}</option>
											@endif
										@endif
									@endfor
		              			</select>
		              			</select>
							</div>
							<div class="form-group col-6">
								<label>Minutos</label>
								<select type="number" class="form-control" id="saida_minutos" placeholder="Minutos" name="saida_minutos" required>
		            			@for($i=0;$i<60;$i++)
										@if($i==$minutos_saida)
											@if($i<10)
											<option value="{{$i}}" selected>0{{$i}}</option>
											@else
											<option value="{{$i}}" selected>{{$i}}</option>
											@endif
										@else
											@if($i<10)
											<option value="{{$i}}" >0{{$i}}</option>
											@else
											<option value="{{$i}}">{{$i}}</option>
											@endif
										@endif
									@endfor
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
						<label for="dias[]" >Domingo</label>
						<input type="checkbox" name="dias[]">
					</div>
					<div class="form-group mr-4">
						<label for="dias[]" >Segunda</label>
						<input type="checkbox" name="dias[]">
					</div>
					<div class="form-group mr-4">
						<label for="dias[]" >Terça</label>
						<input type="checkbox" name="dias[]">
					</div>
					<div class="form-group mr-4">
						<label for="dias[]" >Quarta</label>
						<input type="checkbox" name="dias[]">
					</div>
					<div class="form-group mr-4">
						<label for="dias[]" >Quinta</label>
						<input type="checkbox" name="dias[]">
					</div>
					<div class="form-group mr-4">
						<label for="dias[]" >Sexta</label>
						<input type="checkbox" name="dias[]">
					</div>
					<div class="form-group mr-4">
						<label for="dias[]" >Sábado</label>
						<input type="checkbox" name="dias[]">
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
    checkboxes = document.getElementsByName('dias[]');
	for(var i=0, n=checkboxes.length;i<n;i++) {
    	checkboxes[i].checked = source.checked;
 	 }
 
}









	
</script>
@endsection