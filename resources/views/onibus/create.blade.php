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
			<form method="post" action="{{route('onibus.store')}}">
				@csrf
				<div class="form-row">
					<div class="form-group col-md-6">
						<label>Marca</label>
						<input class="form-control " type="text" name="marca" required>
					</div>
					<div class="form-group">
						<label>Placa</label>
						<input class="form-control " type="text" name="placa" required>
					</div>
					<div class="form-group">
						<label>Lugares</label>
						<input class="form-control " type="number" min="1" name="lugares" required>
					</div>
				</div>
				<button type="submit" class="btn btn-primary">Salvar</button>
			</form>
		</div>
	</div>
</div>
@endsection