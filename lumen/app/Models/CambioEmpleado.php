<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CambioEmpleado extends Model {

    protected $table = 'empleado_cambio';

    protected $casts = [
        'activo' => 'boolean'
    ];

    public function empleado()
    {
        return $this->hasOne(Empleado::class, 'id_empleado');
    }
}
