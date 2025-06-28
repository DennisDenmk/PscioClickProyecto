<?php

namespace App\Http\Controllers;

use App\Models\TipoCita;
use App\Models\Promocion;
use App\Models\PromocionCita;
use App\Models\Cita;

use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function createTipoCita()
    {
        return view('citas.tiposcita.create');
    }
    public function storeTipoCita(Request $request)
    {
        $request->validate(
            [
                'tipc_nombre' => 'required|string|max:100|unique:tipo_citas,tipc_nombre',
                'tipc_duracion_minutos' => 'required|integer|min:1',
            ],
            [
                'tipc_nombre.unique' => 'Ya existe un tipo de cita con ese nombre.',
            ],
        );

        TipoCita::create($request->all());

        return redirect()->route('tipocita.index')->with('success', 'Tipo de cita creado correctamente.');
    }

    public function indexTipoCita()
    {
        $tipos = TipoCita::all();
        return view('citas.tiposcita.index', compact('tipos'));
    }

    public function editTipoCita($id)
    {
        $tipo = TipoCita::findOrFail($id);
        return view('citas.tiposcita.edit', compact('tipo'));
    }

    public function updateTipoCita(Request $request, $id)
    {
        $request->validate([
            'tipc_nombre' => 'required|string|max:100',
            'tipc_duracion_minutos' => 'required|integer|min:1',
        ]);

        $tipo = TipoCita::findOrFail($id);
        $tipo->update($request->all());

        return redirect()->route('tipocita.index')->with('success', 'Tipo de cita actualizado correctamente.');
    }
    //Promociones
    public function indexPromocion()
    {
        $promociones = Promocion::all();
        return view('citas.promocion.index', compact('promociones'));
    }

    public function createPromocion()
    {
        return view('citas.promocion.create');
    }

    public function storePromocion(Request $request)
    {
        $request->validate([
            'prom_nombre' => 'required|string|max:100',
            'prom_descripcion' => 'nullable|string',
            'prom_precio' => 'required|numeric',
            'prom_sesiones' => 'required|integer|min:1',
        ]);

        Promocion::create($request->all());
        return redirect()->route('promociones.index')->with('success', 'Promoción creada correctamente.');
    }

    public function editPromocion($id)
    {
        $promocion = Promocion::findOrFail($id);
        return view('citas.promocion.edit', compact('promocion'));
    }

    public function updatePromocion(Request $request, $id)
    {
        $request->validate([
            'prom_nombre' => 'required|string|max:100',
            'prom_descripcion' => 'nullable|string',
            'prom_precio' => 'required|numeric',
            'prom_sesiones' => 'required|integer|min:1',
        ]);

        $promocion = Promocion::findOrFail($id);
        $promocion->update($request->all());
        return redirect()->route('promociones.index')->with('success', 'Promoción actualizada correctamente.');
    }
    public function indexPromocionCita()
    {
        $promocionesCitas = PromocionCita::with('cita', 'promocion')->get();
        return view('citas.promocioncita.index', compact('promocionesCitas'));
    }

    public function createPromocionCita()
    {
        $citas = Cita::all();
        $promociones = Promocion::all();
        return view('citas.promocioncita.create', compact('citas', 'promociones'));
    }

    public function storePromocionCita(Request $request)
    {
        $request->validate([
            'cit_id' => 'required|exists:citas,cit_id',
            'proc_id' => 'required|exists:promociones,prom_id',
            'proc_sesiones_usadas' => 'required|integer|min:0',
        ]);

        PromocionCita::create($request->all());

        return redirect()->route('promocioncita.index')->with('success', 'Registro creado exitosamente');
    }

    public function editPromocionCita($id)
    {
        $promocionCita = PromocionCita::findOrFail($id);
        $citas = Cita::all();
        $promociones = Promocion::all();

        return view('citas.promocioncita.edit', compact('promocionCita', 'citas', 'promociones'));
    }

    public function updatePromocionCita(Request $request, $id)
    {
        $request->validate([
            'cit_id' => 'required|exists:citas,cit_id',
            'proc_id' => 'required|exists:promociones,prom_id',
            'proc_sesiones_usadas' => 'required|integer|min:0',
        ]);

        $promocionCita = PromocionCita::findOrFail($id);
        $promocionCita->update($request->all());

        return redirect()->route('promocioncita.index')->with('success', 'Registro actualizado correctamente');
    }
}
