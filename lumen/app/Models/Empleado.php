<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Empleado extends Model {

    protected $table = 'empleado';

    protected $primaryKey = 'id_empleado';

    public function cambioEmpleado()
    {
        return $this->belongsTo(CambioEmpleado::class, 'id_empleado');
    }

    public function cambio()
    {
        return $this->HasOne(CambioEmpleado::class, 'id_empleado', 'id_empleado');
    }
}
