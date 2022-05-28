<?php


namespace App\Http\Controllers;
use App\Models\Autobus;
use App\Models\Horario;
use App\Models\Ruta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RutasController extends Controller {

    public function index()
    {
        return Ruta::all();
    }

    public function show($id)
    {
        return Ruta::with(['horario', 'autobus'])
            ->findOrFail($id);
    }

    public function store(Request $request)
    { 
        $validated = $this->validate($request,
            [
                'id_ruta'     => 'nullable|exists:ruta,id_ruta',
                'id_horario'  => 'required|exists:horario,id_horario',
                'id_autobus'  => 'required|exists:autobus,numero_serie',
                'estado'      => 'required|max:254',
                'nombre_ruta' => [
                    'required',
                    Rule::unique('ruta')->ignore((int) $request->get('id_ruta'), 'id_ruta')
                ]
            ],
            [
                'id_horario.required'  => 'El horario es requerido',
                'id_autobus.required'  => 'El autobús es requerido',
                'estado.required'      => 'El estado es requerido',
                'nombre_ruta.required' => 'El nombre de la ruta es requerido',
                'nombre_ruta.unique'   => 'El nombre de la ruta ya existe, elige otro nombre'
            ]);

            DB::table('ruta')->updateOrInsert(
                ['id_ruta' => $validated['id_ruta'] ?? Ruta::count() + 1],
                $validated
            );
    
            return response()->json([
                'message' => 'successfully'
            ]);
    }

    public function delete()
    {
        Ruta::findOrFail(request('id'))->delete();
        return response()->json([
            'message' => 'successfully'
        ]);


    }   

    /*
     * métodos de búsqueda
     */
    public function searchHorario()
    {
        $search = trim(request()->get('search'));

        return Horario::where(static function ($query) use ($search) {
            $query->where('hora_salida', 'LIKE', "%{$search}%")
                ->orWhere('hora_llegada', 'LIKE', "%{$search}%")
                ->orWhere('lugar_inicio', 'LIKE', "%{$search}%")
                ->orWhere('lugar_fin', 'LIKE', "%{$search}%");
        })->select(DB::raw("id_horario as id,CONCAT_WS(' - ', hora_salida, hora_llegada, ' / ' ,CONCAT_WS(' a ', lugar_inicio, lugar_fin)) AS text"))
            ->get();
    }

    public function searchAutobus()
    {
        $search = trim(request()->get('search'));

        return Autobus::where(static function ($query) use ($search) {
            $query->where('numero_serie', 'LIKE', "%{$search}%")
                ->orWhere('placas', 'LIKE', "%{$search}%")
                ->orWhere('modelo', 'LIKE', "%{$search}%");
        })->select(DB::raw("numero_serie as id,CONCAT_WS(' / ', numero_serie, placas, modelo) AS text"))->get();
    }
}
