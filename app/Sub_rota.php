<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub_rota extends Model
{
    public $timestamps = false;
    protected $fillable = ['id_rotas','id_cidade1','id_cidade2','origem','destino','hora_saida','duracao_minutos'];
}
