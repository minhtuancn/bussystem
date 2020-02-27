@extends('home')
@section('conteudo')
<div class="container">
	<div class="row">
		<div class="col-12">
			<form method="post" action="{{route('user.update', ['id' => $user->id])}}">
				@csrf
				<div class="form-row">
					<div class="form-group col-md-12">
						<label>Nome</label>
						<input type="text" class="form-control" id="nome" name="name" value = "{{$user->name}}" required>
					</div>
					<div class="form-group col-md-12">
						<label>Email</label>
						<input type="email" class="form-control" id="email" value = "{{$user->email}}"name="email" required>
					</div>
					<div class="form-group col-md-12">
						<label>Senha</label>
						<input type="password" class="form-control" id="senha" name="senha" required>
					</div>
				</div>
				<button class="btn btn-primary" type="submit">Enviar</button>
			</form>
		</div>
	</div>
</div>
@endsection