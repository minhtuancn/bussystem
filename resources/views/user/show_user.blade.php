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

				<input type="text" class="form-control mb-1" id="busca" onkeyup="myFunction()" placeholder="Busca pelos usuarios">
			</div>
		</div>
			<ul id='list' class="col-12" style = "list-style: none;" id="users" >
				@foreach($users as $user)
				<div id="div{{$user->name}}" class="row border p-3">
					<div class="col-lg-10 col-md-9 col-sm-9 col-xs-2">
						<li id="{{$user->name}}"><a href="#" class="text-dark">{{$user->name}}</a></li>
					</div>
					<div class="col-lg-2 col-md-3 col-sm-3 col-xs-10">
						<a href="{{route('user.edit', ['id' => $user->id])}}"><i class="fas fa-user-edit mr-2"></i></a>
						<a id="{{$user->id}}" href="#" onclick = "modal({{$user->id}})"data-url = "{{route('user.destroy', ['id' => $user->id])}}" data-toggle="modal" data-target="#sure"><i class="fas fa-user-minus mr-2"></i></a>
					</div>
				</div>
				@endforeach
			</ul>
		</div>
	</div>
	
</div>

<div class="modal fade" id="sure" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
      	<h4 class="modal-title ml-3">Tem certeza que quer excluir este usuário?</h4>
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
        var element = document.getElementById(id);
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