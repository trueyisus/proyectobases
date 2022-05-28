<?php


namespace App\Http\Controllers;


use App\Http\Resources\EmpleadoCambioResource;
use App\Models\CambioEmpleado;
use App\Models\Empleado;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CambioEmpleadoController extends Controller {

    public function __construct()
    {
    }

    public function index()
    {
        return EmpleadoCambioResource::collection(CambioEmpleado::all());
    }

    public function show($id)
    {
        return Empleado::with('cambio')->findOrFail($id);
    }

    public function searchEmpleado()
    {
        $search = trim(request()->get('search'));
        return Empleado::where('activo', true)
            ->where(static function ($query) use ($search) {
                $query->where('nombre', 'LIKE', "%{$search}%")
                    ->orWhere('apellido_paterno', 'LIKE', "%{$search}%")
                    ->orWhere('apellido_materno', 'LIKE', "%{$search}%")
                    ->orWhere('telefono', 'LIKE', "%{$search}%")
                    ->orWhere('correo', 'LIKE', "%{$search}%");
            })->select(DB::raw("id_empleado as id,CONCAT_WS('---', id_empleado, CONCAT_WS(' ', nombre, apellido_paterno, apellido_materno)) AS text"))->get([
                'id_empleado',
                'apellido_paterno',
                'apellido_materno',
                'telefono',
                'correo',
            ]);

    }

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'id_empleado' => 'required|exists:empleado,id_empleado',
            'sueldo'      => 'required|numeric|between:0,500000.99',
            'telefono'    => 'required|numeric',
            'correo'      => 'required|email|max:254',
            'direccion'   => 'required|max:100',
            'curp'        => 'required|max:20',
            'rfc'         => 'required|max:20',
            'activo'      => 'required|boolean'
        ]);


        DB::table('empleado_cambio')->updateOrInsert(
            ['id_empleado' => $validated['id_empleado']],
            array_merge($request->except(['_token', 'id_empleado']), ['fecha_cambio' => Carbon::now()->toDateTimeString()])
        );

        return response()->json([
            'message' => 'successfully'
        ]);
    }

    public function update()
    {

    }

    public function delete()
    {
        CambioEmpleado::findOrFail(request('id'))->delete();

        return response()->json([
            'message' => 'successfully'
        ]);
    }

}
