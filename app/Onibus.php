<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Onibus extends Model
{
	public $timestamps = false;
    protected $table = 'onibus';
    protected $fillable = [
    	'marca', 'placa', 'lugares'
    ];
}
