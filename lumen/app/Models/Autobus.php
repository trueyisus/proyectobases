<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Autobus extends Model {

    protected $table = 'autobus';
    protected $primaryKey = 'numero_serie';
    public $keyType = 'string';

}