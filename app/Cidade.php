<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    public $timestamps = false;
    protected $fillable = ['id_rotas', 'cidade', 'hora_de_saida'];
}
