<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passagem extends Model
{
    protected $table = 'passagens';
    public $timestamps = false;
    protected $fillable = ['id_rota', 'id_sub_rota','assento','nome','dia'];
}
