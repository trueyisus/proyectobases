<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EmpleadoCambioResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'id_empleado'   => $this->id_empleado,
            'sueldo'        => $this->sueldo,
            'format_sueldo' => number_format($this->sueldo, 4),
            'telefono'      => $this->telefono,
            'correo'        => $this->correo,
            'direccion'     => $this->direccion,
            'curp'          => $this->curp,
            'rfc'           => $this->rfc,
            'activo'        => $this->activo,
            'format_activo' => $this->activo ? 'SÍ' : 'NO',
            'fecha_cambio'  => Carbon::createFromDate($this->fecha_cambio)->toDateTimeString()
        ];
    }
}
