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
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/functions.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
       

    </head>
    <body style="background: black;">
        <div class="modal" style = "display: block; overflow: visible;"id="sure" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-dialog-lg" role="document">
              <div class="modal-content">
                <h4 class="modal-title ml-3 text-center">Passagem de Ida</h4>
                <div class="modal-body">
                    <center id="modal-centro">
                        <form method="post" action="{{route('welcome.search')}}" autocomplete="off">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <input  id="origem" class="form-control" name="origem" placeholder="Origem" required>
                                </div>
                            </div>
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <input id="destino" class="form-control" name="destino" placeholder="Destino" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <input class="form-control" id="date" name="date" placeholder="Selecione a data de ida" type="text" min={{$date}} required onkeypress="return false;"/>
                                    </div>
                                </div>
                                <button type="submit" onclick="validatePassword('origem'), validatePassword('destino');" class="btn btn-secondary">Procurar</button>
                        </form>
                    </center>
                </div>
              </div>
            </div>
        </div>
    </body>
</html>

<script>
    $(document).ready(function(){
      var date_input=$('input[name="date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var min = $('#date').attr('min');
      var options={
        format: 'dd-mm-yyyy',
        startDate: min,
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
var cidades = []
$(function() {
  
  $.getJSON('estados_cidades1.json', function (data) {
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
    console.log(element.value);
        if(!(cidades.includes(element.value))) {
            element.setCustomValidity('Cidade não cadastrada');
        }
        else {
            element.setCustomValidity('');
        }
    }

</script>