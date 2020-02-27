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
			<form method="post" action="{{route ('user.store')}}" > 
				@csrf
				<div class="form-row">
					<div class="form-group col-md-12">
						<label>Nome</label>
						<input type="text" class="form-control" id="nome" name="name" required>
					</div>
					<div class="form-group col-md-12">
						<label>Email</label>
						<input type="email" class="form-control" id="email" name="email" required>
					</div>
					<div class="form-group col-md-12">
						<label>Senha</label>
						<input type="password" class="form-control" id="senha" name="senha" required>
					</div>
					<div class="form-group col-md-12">
						<label>Confirmar Senha</label>
						<input type="password" class="form-control" id="confsenha" name="senha"required>
					</div>
				</div>
				<button class="btn btn-primary" type="submit">Enviar</button>

			</form>
		</div>
	</div>
	
</div>
@endsection
@section('script')
<script>
	var senha = document.getElementById('senha');
	var confirmar = document.getElementById('confsenha');
	var nome = document.getElementById('nome');
	function validatePassword() {
		if(senha.value!=confirmar.value) {
			confirmar.setCustomValidity('Senhas não são iguais');
		}
		else {
			confirmar.setCustomValidity('');
		}
	}
	senha.onchange = validatePassword;
	confirmar.onkeyup = validatePassword; 

</script>
@endsection