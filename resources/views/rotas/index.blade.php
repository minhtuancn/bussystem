@extends('home')
@section('conteudo')
<div  class="container my-4">
		<div class="row">
			<div class="col-12">
        @if (session('message'))
          <div class="alert alert-danger">
            {{ session('message') }}
          </div>
        @endif
        @if (session('message-success'))
          <div class="alert alert-success">
            {{ session('message-success') }}
          </div>
        @endif

				<input type="text" class="form-control mb-1" id="busca" onkeyup="myFunction()" placeholder="Busca pelos onibus">
			</div>
		</div>
      <div style="overflow-y: scroll; height: 350px" >
  			<ul id='list' class="col-12" style = "list-style: none;" id="buses" >
  				@foreach($rotas as $rota)
  				<div id="div{{$rota->id}}" class="row border p-3">
  					<div class="col-lg-10 col-md-9 col-sm-9 col-xs-2">
  						<li id="{{$rota->id}}"><a title="Veja os detalhes da rota de {{$rota->origem}} à {{$rota->destino}}, bem como suas paradas;" href="{{route('rota.show', ['id' => $rota->id])}}" class="text-dark">{{$rota->origem}} - {{$rota->destino}}</a></li>
  					</div>
  					<div class="col-lg-2 col-md-3 col-sm-3 col-xs-10">
              <a title = "Criar uma nova parada" href="{{route('cidades.create', ['id' => $rota->id])}}"><i class="fas fa-user-plus mr-2"></i></a>
  						<a title = "Editar a rota" href="{{route('rota.edit', ['id' => $rota->id])}}"><i class="fas fa-user-edit mr-2"></i></a>
  						<a id="a{{$rota->id}}" title = "Excluir a rota" id="{{$rota->id}}" href="#" onclick = "modal({{$rota->id}})" data-url = "{{route('rota.destroy', ['id' => $rota->id])}}" data-toggle="modal" data-target="#sure"><i class="fas fa-user-minus mr-2"></i></a>
  					</div>
  				</div>
  				@endforeach
  			</ul>
	</div>
  <a href="{{route('rota.create')}}" class="btn btn-primary">Adicionar Rota</a>
  
</div>

<div class="modal fade" id="sure" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
      	<h4 class="modal-title ml-3">Tem certeza que quer excluir esta rota?</h4>
      	<div class="modal-body">
      		<center id="modal-centro">
      			<button style="border: none; background: none;"><a id = "modal-link" class="text-dark" href=""><i class="fas fa-check-square display-4"></i></a></button>
      			<button type="button" style="border: none; background: none;" data-dismiss="modal"><i class="fas fa-times display-4"></i></button>
      		</center>
      	</div>
      </div>
    </div>
</div>
@endsection

@section('script')
<script>
var route = "";
function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("busca");
    filter = input.value.toUpperCase();
    ul = document.getElementById("list");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            var str = "div"+li[i].id;
            var div = document.getElementById(str)
            div.style.display = "";
        } else {
            var str = "div"+li[i].id;
            var div = document.getElementById(str);
            div.style.display = "none";
        }
    }
}


function modal(id) {
        console.log(id);
        var element = document.getElementById('a'+id);
        var route = element.getAttribute('data-url');
        console.log(route);
        var link = document.getElementById("modal-link");
        link.href = route;
    }



/*function oo() {
    $('[data-toggle="popover"]').popover();
  }*/
</script>
@endsection