<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rotas extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'id_onibus','origem','destino',	'hora_de_saida','duracao_minutos','domingo','segunda',	'terca','quarta','quinta','sexta','sabado'
    ];
}
