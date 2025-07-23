<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AgregarFuncionesPersonalizadas extends Migration
{
    public function up(): void
    {
        DB::unprepared("
            SET TIME ZONE 'America/Guayaquil';

            DO \$\$
            BEGIN
                IF EXISTS (SELECT 1 FROM pg_type WHERE typname = 'resultado_cita') THEN
                    DROP TYPE resultado_cita;
                END IF;
            END
            \$\$;

            CREATE TYPE resultado_cita AS (
                mensaje TEXT,
                cit_id INT
            );

            CREATE OR REPLACE FUNCTION crear_cita(
                p_paciente_id VARCHAR(10),
                p_doctor_id VARCHAR(10),
                p_tipc_id INT,
                p_cit_fecha DATE,
                p_cit_hora_inicio TIME,
                p_cit_motivo_consulta TEXT DEFAULT NULL
            )
            RETURNS resultado_cita AS \$\$
            -- (tu lógica de la función aquí)
            \$\$ LANGUAGE plpgsql;

            CREATE OR REPLACE FUNCTION actualizar_cita(
                p_cit_id INT,
                p_paciente_id VARCHAR(10),
                p_doctor_id VARCHAR(10),
                p_tipc_id INT,
                p_cit_fecha DATE,
                p_cit_hora_inicio TIME,
                p_cit_motivo_consulta TEXT DEFAULT NULL
            )
            RETURNS resultado_cita AS \$\$
            -- (tu lógica aquí)
            \$\$ LANGUAGE plpgsql;

            CREATE OR REPLACE FUNCTION validar_cedula_ecuatoriana(cedula varchar(10))
            RETURNS BOOLEAN AS \$\$
            -- (tu lógica aquí)
            \$\$ LANGUAGE plpgsql;

            CREATE OR REPLACE FUNCTION validar_correo_electronico(correo varchar(320))
            RETURNS BOOLEAN AS \$\$
            -- (tu lógica aquí)
            \$\$ LANGUAGE plpgsql;
        ");
    }

    public function down(): void
    {
        DB::unprepared("
            DROP FUNCTION IF EXISTS crear_cita(
                VARCHAR, VARCHAR, INT, DATE, TIME, TEXT
            );
            DROP FUNCTION IF EXISTS actualizar_cita(
                INT, VARCHAR, VARCHAR, INT, DATE, TIME, TEXT
            );
            DROP FUNCTION IF EXISTS validar_cedula_ecuatoriana(VARCHAR);
            DROP FUNCTION IF EXISTS validar_correo_electronico(VARCHAR);
            DROP TYPE IF EXISTS resultado_cita;
        ");
    }
}
