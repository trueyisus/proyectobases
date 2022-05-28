<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Ruta extends Model {

    protected $table = 'ruta';
    protected $primaryKey = 'id_ruta';

    public function horario()
    {
        return $this->hasOne(Horario::class, 'id_horario', 'id_horario');
    }

    public function autobus()
    {
        return $this->hasOne(Autobus::class, 'numero_serie', 'id_autobus');
    }
}
