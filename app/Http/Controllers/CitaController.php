<?php

namespace App\Http\Controllers;

use App\Models\TipoCita;
use App\Models\Promocion;
use App\Models\PromocionCita;
use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Doctor;
use App\Models\EstadoCita;
use App\Models\User;
use App\Notifications\CitaAsignada;

use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CitaController extends Controller
{
    public function show($id)
    {
        $cita = Cita::with(['paciente', 'doctor', 'tipoCita', 'estadoCita', 'historiaClinica'])->findOrFail($id);

        return view('citas.show', compact('cita'));
    }
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
    public function indexCita(Request $request)
    {
        $fecha = $request->input('fecha');
        $estado = $request->input('estado');

        $citas = Cita::with(['paciente', 'doctor', 'tipoCita', 'estadoCita'])
            ->when($fecha, function ($query, $fecha) {
                $query->whereDate('cit_fecha', $fecha);
            })
            ->when($estado, function ($query, $estado) {
                $query->where('estc_id', $estado);
            })
            ->orderBy('cit_fecha', 'desc')
            ->paginate(10);

        // También puedes pasar todos los estados disponibles para el filtro
        $estados = EstadoCita::all();

        return view('citas.index', compact('citas', 'fecha', 'estado', 'estados'));
    }

    public function createCita()
    {
        $pacientes = Paciente::all();
        $doctores = Doctor::all();
        $tipos = TipoCita::all();
        $estados = EstadoCita::all();

        return view('citas.create', compact('pacientes', 'doctores', 'tipos', 'estados'));
    }

    public function storeCita(Request $request)
    {
        // Validaciones básicas de los datos de entrada
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,pac_cedula',
            'doctor_id' => 'required|exists:doctores,doc_cedula',
            'tipc_id' => 'required|exists:tipo_citas,tipc_id',
            'cit_fecha' => 'required|date|after_or_equal:today',
            'cit_hora_inicio' => 'required|date_format:H:i',
            'cit_motivo_consulta' => 'nullable|string|max:255',
        ]);

        // Llamar al procedimiento almacenado
        try {
            // Convertir la hora a formato compatible con PostgreSQL si es necesario (H:i:s)
            $horaInicio = $request->cit_hora_inicio . ':00';

            // Ejecutar la función del procedimiento almacenado
            $resultado = DB::selectOne('SELECT crear_cita(?, ?, ?, ?, ?, ?)', [$request->paciente_id, $request->doctor_id, $request->tipc_id, $request->cit_fecha, $horaInicio, $request->cit_motivo_consulta]);
            $mensaje = (array) $resultado;
            $mensaje = reset($mensaje); // Obtiene el primer valor del array

            // Si el mensaje indica un error
            if (str_starts_with($mensaje, 'Error:')) {
                return back()
                    ->withErrors(['general' => $mensaje]) // Un error general para mostrar al usuario
                    ->withInput();
            }
            $doctorUser = User::where('cedula', $request->doctor_id)->first();
            if ($doctorUser) {
                $doctorUser->notify(
                    new CitaAsignada([
                        'fecha' => $request->cit_fecha,
                        'hora' => $request->cit_hora_inicio,
                        'paciente' => $request->paciente_id,
                        'motivo' => $request->cit_motivo_consulta,
                    ]),
                );
            }

            return redirect()->route('citas.index')->with('success', $mensaje);
        } catch (\Illuminate\Database\QueryException $e) {
            // Capturar excepciones de la base de datos (ej. si la función no existe o hay un error fatal)
            return back()
                ->withErrors(['general' => 'Ocurrió un error al intentar crear la cita. Por favor, intente de nuevo.'])
                ->withInput();
        }
    }

    public function editCita($id)
    {
        $cita = Cita::findOrFail($id);
        $pacientes = Paciente::all();
        $doctores = Doctor::all();
        $tipos = TipoCita::all();
        $estados = EstadoCita::all();

        return view('citas.edit', compact('cita', 'pacientes', 'doctores', 'tipos', 'estados'));
    }

    public function updateCita(Request $request, $id)
    {
        // Validaciones básicas de los datos de entrada
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,pac_cedula',
            'doctor_id' => 'required|exists:doctores,doc_cedula',
            'tipc_id' => 'required|exists:tipo_citas,tipc_id',
            'estc_id' => 'required|exists:estado_citas,estc_id',
            'cit_fecha' => 'required|date',
            'cit_hora_inicio' => 'required|date_format:H:i',
            'cit_motivo_consulta' => 'nullable|string|max:255',
        ]);

        try {
            // Convertir la hora a formato compatible con PostgreSQL (H:i:s)
            $horaInicio = $request->cit_hora_inicio . ':00';

            // Ejecutar la función del procedimiento almacenado para actualizar
            $resultado = DB::selectOne('SELECT actualizar_cita_sin_horarios(?, ?, ?, ?, ?, ?, ?, ?)', [
                $id, // ID de la cita a actualizar
                $request->paciente_id,
                $request->doctor_id,
                $request->tipc_id,
                $request->estc_id, // Incluir el estc_id
                $request->cit_fecha,
                $horaInicio,
                $request->cit_motivo_consulta,
            ]);

            // El resultado de DB::selectOne es un objeto, necesitamos acceder a la propiedad
            $mensaje = (array) $resultado;
            $mensaje = reset($mensaje); // Obtiene el primer valor del array

            // Si el mensaje indica un error
            if (str_starts_with($mensaje, 'Error:')) {
                return back()
                    ->withErrors(['general' => $mensaje])
                    ->withInput();
            }

            return redirect()->route('citas.index')->with('success', $mensaje);
        } catch (\Illuminate\Database\QueryException $e) {
            return back()
                ->withErrors(['general' => 'Ocurrió un error al intentar actualizar la cita. Por favor, intente de nuevo.'])
                ->withInput();
        }
    }

    public function citasCalendarioSecretario(): JsonResponse
    {
        $citas = Cita::with(['paciente', 'doctor', 'tipoCita', 'estadoCita'])->get();

        // Transformar citas al formato esperado por FullCalendar
        $eventos = $citas->map(function ($cita) {
            // Mapear estados a clases CSS
            $estadoClase = $this->getEstadoClase($cita->estadoCita->estc_nombre);

            return [
                'id' => $cita->cit_id,
                'title' => "{$cita->tipoCita->tipc_nombre} - {$cita->paciente->pac_nombres} {$cita->paciente->pac_apellidos}",
                'estado' => $estadoClase, // Clase CSS para el color
                'estadoTexto' => $cita->estadoCita->estc_nombre, // Texto del estado
                'start' => $cita->cit_fecha . 'T' . $cita->cit_hora_inicio,
                'end' => $cita->cit_fecha . 'T' . $cita->cit_hora_fin,
                'url' => route('citas.show', $cita->cit_id),
                'edit' => route('citas.edit', $cita->cit_id),
                'extendedProps' => [
                    'estado' => $estadoClase,
                    'estadoTexto' => $cita->estadoCita->estc_nombre,
                    'doctor' => $cita->doctor->doc_nombres . ' ' . $cita->doctor->doc_apellidos,
                    'paciente' => $cita->paciente->pac_nombres . ' ' . $cita->paciente->pac_apellidos,
                    'tipo' => $cita->tipoCita->tipc_nombre,
                    'telefono' => $cita->paciente->pac_telefono ?? 'No disponible',
                ],
            ];
        });

        return response()->json($eventos);
    }

    public function citasCalendarioDoctor(): JsonResponse
    {
        $cedula = Auth::user()->cedula;

        // Buscar al doctor con esa cédula
        $doctor = Doctor::where('doc_cedula', $cedula)->first();

        if (!$doctor) {
            return response()->json([]);
        }

        $citas = Cita::with(['paciente', 'doctor', 'tipoCita', 'estadoCita'])
            ->where('doctor_id', $doctor->doc_cedula)
            ->get();

        $eventos = $citas->map(function ($cita) {
            $estadoClase = $this->getEstadoClase($cita->estadoCita->estc_nombre);

            return [
                'id' => $cita->cit_id,
                'title' => "{$cita->tipoCita->tipc_nombre} - {$cita->paciente->pac_nombres} {$cita->paciente->pac_apellidos}",
                'estado' => $estadoClase,
                'estadoTexto' => $cita->estadoCita->estc_nombre,
                'start' => $cita->cit_fecha . 'T' . $cita->cit_hora_inicio,
                'end' => $cita->cit_fecha . 'T' . $cita->cit_hora_fin,
                'url' => route('citas.show', $cita->cit_id),
                'edit' => route('citas.edit', $cita->cit_id),
                'extendedProps' => [
                    'estado' => $estadoClase,
                    'estadoTexto' => $cita->estadoCita->estc_nombre,
                    'doctor' => $cita->doctor->doc_nombres . ' ' . $cita->doctor->doc_apellidos,
                    'paciente' => $cita->paciente->pac_nombres . ' ' . $cita->paciente->pac_apellidos,
                    'tipo' => $cita->tipoCita->tipc_nombre,
                    'telefono' => $cita->paciente->pac_telefono ?? 'No disponible',
                ],
            ];
        });

        return response()->json($eventos);
    }

    private function getEstadoClase(string $estadoNombre): string
    {
        $estados = [
            'Pendiente' => 'pendiente',
            'Confirmada' => 'confirmada',
            'Confirmado' => 'confirmada',
            'Cancelada' => 'cancelada',
            'Cancelado' => 'cancelada',
            'Completada' => 'completada',
            'Completado' => 'completada',
            'Finalizada' => 'completada',
            'Finalizado' => 'completada',
        ];

        return $estados[$estadoNombre] ?? 'pendiente';
    }
    public function citasCalendario(): JsonResponse
    {
        $user = Auth::user();
        $rol = $user->role_id;
        //Rol de doctor
        if ($rol === 2) {
            return $this->citasCalendarioDoctor();
        } elseif ($rol === 3) {
            //Rol de secretario
            return $this->citasCalendarioSecretario();
        }
        return response()->json([]);
    }
    public function mostrarCalendario()
    {
        return view('citas.calendario');
    }
    public function porFecha($fecha)
    {
        $citas = Cita::with(['paciente', 'doctor'])
            ->whereDate('cit_fecha', $fecha)
            ->get()
            ->map(function ($cita) {
                return [
                    'hora' => $cita->cit_hora_inicio,
                    'paciente' => $cita->paciente->pac_nombres . ' ' . $cita->paciente->pac_apellidos,
                    'doctor' => $cita->doctor->doc_nombres . ' ' . $cita->doctor->doc_apellidos,
                ];
            });

        return response()->json($citas);
    }
}
