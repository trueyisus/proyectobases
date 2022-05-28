<?php


namespace App\Http\Controllers;

use App\Models\Horario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HorariosController extends Controller{

    public function index()
    {
        return Horario::all() ?? [];
    }

    public function show($id)
    {
        return Horario::findOrFail($id);
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'id_horario'   => 'nullable|exists:horario,id_horario',
            'hora_salida'  => 'required',
            'hora_llegada' => 'required',
            'lugar_inicio' => 'required|max:254',
            'lugar_fin'    => 'required|max:254'
        ]);


        DB::table('horario')->updateOrInsert(
            ['id_horario' => $validated['id_horario'] ?? Horario::count() + 1],
            $validated);

        return response()->json([
                'message' => 'successfully'
            ]);
    }

    public function delete()
    {
        Horario::findOrFail(request('id'))->delete();

        return response()->json([
            'message' => 'successfully'
        ]);
    }

}
