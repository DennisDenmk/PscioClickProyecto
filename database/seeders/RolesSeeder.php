<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['nombre' => 'administrador', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'doctor',        'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'secretario',    'created_at' => now(), 'updated_at' => now()],
        ]);
        DB::table('estado_citas')->insert([
            ['estc_nombre' => 'Pendiente',   'created_at' => now(), 'updated_at' => now()],
            ['estc_nombre' => 'Confirmada',  'created_at' => now(), 'updated_at' => now()],
            ['estc_nombre' => 'Cancelada',   'created_at' => now(), 'updated_at' => now()],
            ['estc_nombre' => 'Completada',  'created_at' => now(), 'updated_at' => now()],
        ]);
        DB::table('tipo_habito')->insert([
            ['tipo_hab_nombre' => 'Fumar',               'created_at' => now(), 'updated_at' => now()],
            ['tipo_hab_nombre' => 'Beber',               'created_at' => now(), 'updated_at' => now()],
            ['tipo_hab_nombre' => 'Ejercicio',           'created_at' => now(), 'updated_at' => now()],
            ['tipo_hab_nombre' => 'Drogas',              'created_at' => now(), 'updated_at' => now()],
            ['tipo_hab_nombre' => 'Pasatiempo',          'created_at' => now(), 'updated_at' => now()],
            ['tipo_hab_nombre' => 'Se automedica',       'created_at' => now(), 'updated_at' => now()],
            ['tipo_hab_nombre' => 'Alimentación',        'created_at' => now(), 'updated_at' => now()],
            ['tipo_hab_nombre' => 'Hidratación',         'created_at' => now(), 'updated_at' => now()],
            ['tipo_hab_nombre' => 'Diuresis',            'created_at' => now(), 'updated_at' => now()],
            ['tipo_hab_nombre' => 'Deposiciones',        'created_at' => now(), 'updated_at' => now()],
        ]);


        DB::table('tipo_enfermedad_actual')->insert([
            ['tipo_enf_nombre' => 'Hipertensión',       'created_at' => now(), 'updated_at' => now()],
            ['tipo_enf_nombre' => 'Diabetes',           'created_at' => now(), 'updated_at' => now()],
            ['tipo_enf_nombre' => 'Dolor de cabeza',    'created_at' => now(), 'updated_at' => now()],
        ]);

        // Tabla tipo_antecedente
        DB::table('tipo_antecedente')->insert([
            ['tipa_nombre' => 'Heredofamiliar',           'created_at' => now(), 'updated_at' => now()],
            ['tipa_nombre' => 'Patológico',               'created_at' => now(), 'updated_at' => now()],
            ['tipa_nombre' => 'No Patológico',            'created_at' => now(), 'updated_at' => now()],
            ['tipa_nombre' => 'Diabetes',                 'created_at' => now(), 'updated_at' => now()],
            ['tipa_nombre' => 'Hipertensión (HTA)',       'created_at' => now(), 'updated_at' => now()],
            ['tipa_nombre' => 'Cáncer',                   'created_at' => now(), 'updated_at' => now()],
            ['tipa_nombre' => 'Transfusiones',            'created_at' => now(), 'updated_at' => now()],
            ['tipa_nombre' => 'Enfermedades reumáticas',  'created_at' => now(), 'updated_at' => now()],
            ['tipa_nombre' => 'Fracturas',                'created_at' => now(), 'updated_at' => now()],
            ['tipa_nombre' => 'Accidentes',               'created_at' => now(), 'updated_at' => now()],
            ['tipa_nombre' => 'Cardiopatías',             'created_at' => now(), 'updated_at' => now()],
            ['tipa_nombre' => 'Cirugías',                 'created_at' => now(), 'updated_at' => now()],
            ['tipa_nombre' => 'Espasmos',                 'created_at' => now(), 'updated_at' => now()],
            ['tipa_nombre' => 'Espasmos (características)','created_at' => now(), 'updated_at' => now()],
        ]);
        DB::table('estados_civiles')->insert([
            ['estc_nombre' => 'Soltero', 'created_at' => now(), 'updated_at' => now()],
            ['estc_nombre' => 'Casado', 'created_at' => now(), 'updated_at' => now()],
            ['estc_nombre' => 'Divorciado', 'created_at' => now(), 'updated_at' => now()],
            ['estc_nombre' => 'Viudo', 'created_at' => now(), 'updated_at' => now()],
        ]);
        DB::table('users')->insert([
            [
                'name' => 'Administrador',
                'apellido' => 'Administrador',
                'cedula' => '1111111111',
                'email' => 'admin@admin',
                'telefono' => '0000000001',
                'password' =>Hash::make('123456789'),
                'role_id' => 1,
                'estado' => true,
            ],
            [
                'name' => 'Secre',
                'apellido' => 'Secre',
                'cedula' => '2222222222',
                'email' => 'secre@secre',
                'telefono' => '0000000002',
                'password' => Hash::make('123456789'),
                'role_id' => 3,
                'estado' => true,
            ],
            [
                'name' => 'Doctor',
                'apellido' => 'Secre',
                'cedula' => '3333333333',
                'email' => 'doc@doc',
                'telefono' => '0000000003',
                'password' => Hash::make('123456789'),
                'role_id' => 2,
                'estado' => true,
            ]
        ]);

         DB::table('promociones')->insert([
            [
                'prom_nombre'     => 'Primera sesión y valoración',
                'prom_descripcion'=> 'Incluye la evaluación inicial del paciente y una sesión de tratamiento.',
                'prom_precio'     => 10.00,
                'prom_sesiones'   => 1,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'prom_nombre'     => 'Tres sesiones',
                'prom_descripcion'=> 'Paquete con 3 sesiones de tratamiento.',
                'prom_precio'     => 24.00,
                'prom_sesiones'   => 3,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'prom_nombre'     => 'Seis sesiones',
                'prom_descripcion'=> 'Paquete con 6 sesiones de tratamiento.',
                'prom_precio'     => 45.00,
                'prom_sesiones'   => 6,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'prom_nombre'     => 'Doce sesiones',
                'prom_descripcion'=> 'Paquete completo de 12 sesiones.',
                'prom_precio'     => 85.00,
                'prom_sesiones'   => 12,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'prom_nombre'     => 'Masaje relajante Antiestrés',
                'prom_descripcion'=> 'Masaje terapéutico para reducir el estrés.',
                'prom_precio'     => 20.00,
                'prom_sesiones'   => 1,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'prom_nombre'     => 'Masaje deportivo',
                'prom_descripcion'=> 'Masaje especializado para atletas o lesiones deportivas.',
                'prom_precio'     => 20.00,
                'prom_sesiones'   => 1,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ]);

    }
}
