<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventoSeeder extends Seeder
{
    public function run()
    {
        DB::table('evento')->insert([
            [
                'nombre' => 'Feria de las Flores - Medellín 2025',
                'descripcion' => 'La feria más tradicional de Antioquia con desfile de silleteros, conciertos y eventos culturales. Una celebración de la cultura paisa y la diversidad floral de la región.',
                'fecha_hora_inicio' => '2025-11-15 09:00:00',
                'fecha_hora_fin' => '2025-11-20 22:00:00',
                'municipio' => 'Medellín',
                'departamento' => 'Antioquia',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nombre' => 'Carnaval de Barranquilla - Edición Especial',
                'descripcion' => 'El carnaval más alegre y colorido de Colombia. Disfruta de desfiles, música tradicional, danzas folclóricas y la riqueza cultural del Caribe colombiano.',
                'fecha_hora_inicio' => '2025-11-25 08:00:00',
                'fecha_hora_fin' => '2025-11-28 23:00:00',
                'municipio' => 'Barranquilla',
                'departamento' => 'Atlántico',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}