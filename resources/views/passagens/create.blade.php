<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Onibus</title>
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <style>
*, *:before, *:after {
   box-sizing: border-box;
}
 html {
   font-size: 16px;
}
 .plane {
   margin: 20px auto;
   max-width: 250px;
}
 .fuselage {
   border: 5px solid #d8d8d8;
   /*border: 5px solid #d8d8d8;*/
}
 ol {
   list-style: none;
   padding: 0;
   margin: 0;
}
 .seats {
   display: flex;
   flex-direction: row;
   flex-wrap: nowrap;
   justify-content: flex-start;
}
 .seat {
   display: flex;
   flex: 0 0 18.2857142857%;
   padding: 5px;
   position: relative;
}
 .seat:nth-child(2) {
   margin-right: 27.2857142857%;
}
 .seat input[type=checkbox] {
   position: absolute;
   opacity: 0;
}
 .seat input[type=checkbox]:checked + label {
   background: yellow;
   -webkit-animation-name: rubberBand;
   animation-name: rubberBand;
   animation-duration: 300ms;
   animation-fill-mode: both;
}
 .seat input[type=checkbox]:disabled + label {
   background: #ddd;
   text-indent: -9999px;
   overflow: hidden;
}
 .seat input[type=checkbox]:disabled + label:after {
   content: "X";
   text-indent: 0;
   position: absolute;
   top: 4px;
   left: 50%;
   transform: translate(-50%, 0%);
}
 .seat input[type=checkbox]:disabled + label:hover {
   box-shadow: none;
   cursor: not-allowed;
}
 .seat label {
   display: block;
   position: relative;
   width: 100%;
   text-align: center;
   font-size: 14px;
   font-weight: bold;
   line-height: 1.5rem;
   padding: 4px 0;
   background: #bada55;
   border-radius: 5px;
   animation-duration: 300ms;
   animation-fill-mode: both;
}
 .seat label:before {
   content: "";
   position: absolute;
   width: 75%;
   height: 75%;
   top: 1px;
   left: 50%;
   transform: translate(-50%, 0%);
   background: rgba(255, 255, 255, .4);
   border-radius: 3px;
}
 .seat label:hover {
   cursor: pointer;
   box-shadow: 0 0 0px 2px #5c6aff;
}
 @-webkit-keyframes rubberBand {
   0% {
     -webkit-transform: scale3d(1, 1, 1);
     transform: scale3d(1, 1, 1);
  }
   30% {
     -webkit-transform: scale3d(1.25, 0.75, 1);
     transform: scale3d(1.25, 0.75, 1);
  }
   40% {
     -webkit-transform: scale3d(0.75, 1.25, 1);
     transform: scale3d(0.75, 1.25, 1);
  }
   50% {
     -webkit-transform: scale3d(1.15, 0.85, 1);
     transform: scale3d(1.15, 0.85, 1);
  }
   65% {
     -webkit-transform: scale3d(0.95, 1.05, 1);
     transform: scale3d(0.95, 1.05, 1);
  }
   75% {
     -webkit-transform: scale3d(1.05, 0.95, 1);
     transform: scale3d(1.05, 0.95, 1);
  }
   100% {
     -webkit-transform: scale3d(1, 1, 1);
     transform: scale3d(1, 1, 1);
  }
}
 @keyframes rubberBand {
   0% {
     -webkit-transform: scale3d(1, 1, 1);
     transform: scale3d(1, 1, 1);
  }
   30% {
     -webkit-transform: scale3d(1.25, 0.75, 1);
     transform: scale3d(1.25, 0.75, 1);
  }
   40% {
     -webkit-transform: scale3d(0.75, 1.25, 1);
     transform: scale3d(0.75, 1.25, 1);
  }
   50% {
     -webkit-transform: scale3d(1.15, 0.85, 1);
     transform: scale3d(1.15, 0.85, 1);
  }
   65% {
     -webkit-transform: scale3d(0.95, 1.05, 1);
     transform: scale3d(0.95, 1.05, 1);
  }
   75% {
     -webkit-transform: scale3d(1.05, 0.95, 1);
     transform: scale3d(1.05, 0.95, 1);
  }
   100% {
     -webkit-transform: scale3d(1, 1, 1);
     transform: scale3d(1, 1, 1);
  }
}
 .rubberBand {
   -webkit-animation-name: rubberBand;
   animation-name: rubberBand;
}
 
 
 
 

</style>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/functions.js"></script>
        
</head>
<body>
<div class="container">
  <form method="post" action="{{route('passagem.store')}}"> 
    @csrf
    <input type="hidden" value="{{$date}} "name="dia">
    <input type="hidden" value="{{$id}} "name="id_rota">
    <input type="hidden" value="{{$subrota_id}} "name="id_sub_rota">
    <input type="hidden" value="{{$lugares}} "name="lugares">
    <div class="row">
      <div class="col-lg-6 col-sm-12">
        <div class="plane">
          <ol class="cabin fuselage">
            @for($i=1;$i<=$lugares;$i = $i + 4)
            <li class="linha linha--1">
              <ol class="seats" type="A">
                @for($j=$i;$j<$i+4;$j++)
                  @if($i<=$lugares)
                    @if(in_array($j, $assentos))
                      <li class="seat">
                        <input onclick="check({{$j}})" class="checkbox" type="checkbox" disabled id="{{$j}}" name="a{{$j}}" />
                        <label for="{{$j}}">Occupied</label>
                      </li>
                    @else
                      <li class="seat">
                        <input onclick="check({{$j}})" class="checkbox" type="checkbox" id="{{$j}}" name="a{{$j}}" />
                        <label for="{{$j}}">{{$j}}</label>
                      </li>
                    @endif
                  @endif
                @endfor
              </ol>
            </li>
            @endfor
          </ol>
        </div>
      </div>
      <div class="col-lg-6 col-sm-12 mt-4"> 
            <div class="form-group col-lg-6 col-sm-12">
              <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome completo" required>
            </div>
            <div class="form-group col-lg-6 col-sm-12">
                <button type="submit" onclick = "verify()"class="btn btn-primary">Reservar</button>
            </div>
      </div>
    </div>

  </form>
</div>


</body>
</html>

<script>
 function check(id) {
    checkboxes = document.getElementsByClassName('checkbox');
  for(var i=1, n=checkboxes.length;i<=n;i++) {
    if(i!=parseInt(id)) {
      checkboxes[i-1].checked = false;
    }
    else {
      checkboxes[i-1].checked = true;
    }
   }
 
}

function verify() {
  checkboxes = document.getElementsByClassName('checkbox');
  var ok = 0
  for(var i=0, n=checkboxes.length;i<n;i++) {
    if(checkboxes[i].checked == true) {
        ok = 1;
        break;
    }
  }
  if(ok==0) {
    document.getElementById('nome').setCustomValidity('Escolha um assento!');
  }
  else {
    console.log('sf')
    document.getElementById('nome').setCustomValidity('');

  }
}
</script>


