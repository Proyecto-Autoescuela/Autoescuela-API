<?php

use Illuminate\Database\Seeder;

class TestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            'photo_url' => 'ImagesTests/camion.png',
            'question' => '¿Que es la MMA de un vehículo?',
            'answer_a' => 'La masa de vehículo',
            'answer_b' => 'La masa máxima autorizada para la utilización del vehículo',
            'answer_c' => 'La suma de las masas del vehículo de motor y del remolque arrastrado',
            'correct_answer' => 'answer_b',
            'unit_id' => '1',
        ]);

        DB::table('questions')->insert([
            'photo_url' => 'ImagesTests/cuadriciclo.png',
            'question' => 'Un cuatriciclo ligero, ¿se considera un vehículo de motor?',
            'answer_a' => 'Sí',
            'answer_b' => 'No',
            'answer_c' => 'Se considera un vehículo de motor, pero no tiene las misma reglas',
            'correct_answer' => 'answer_b',
            'unit_id' => '1',
        ]);

        DB::table('questions')->insert([
            'photo_url' => 'ImagesTests/moto.png',
            'question' => '¿Qué alumbrado llevará encendido una motocicleta durante el día?',
            'answer_a' => 'El de corto alcance o cruce',
            'answer_b' => 'El de posición o el de corto alcance',
            'answer_c' => 'Ninguno',
            'correct_answer' => 'answer_a',
            'unit_id' => '1',
        ]);

        DB::table('questions')->insert([
            'photo_url' => 'ImagesTests/camion.png',
            'question' => 'En una autopista conduciendo un camión de 3000kg de MMA, ¿qué distancia es obligatorio dejar con el vehículo que va delante?',
            'answer_a' => '100 metros',
            'answer_b' => '50 metros',
            'answer_c' => 'La distancia de seguridad',
            'correct_answer' => 'answer_c',
            'unit_id' => '1',
        ]);

        DB::table('questions')->insert([
            'photo_url' => 'ImagesTests/seguros.png',
            'question' => 'El seguro obligatorio, ¿cubre los daños en la persona del conductor del vehículo asegurado?',
            'answer_a' => 'Sí, en todo caso',
            'answer_b' => 'Sí, salvo cuando el conductor es el tomador del seguro.',
            'answer_c' => 'No',
            'correct_answer' => 'answer_c',
            'unit_id' => '2',
        ]);

        DB::table('questions')->insert([
            'photo_url' => 'ImagesTests/alcohol.png',
            'question' => '¿Cúal es la tasa de alcohol máxima permitida a un conductor novel?',
            'answer_a' => '0,25 miligramos de alcohol por litro de aire espirado.',
            'answer_b' => '0,3 miligramos de alcohol por litro de aire espirado.',
            'answer_c' => '0,15 miligramos de alcohol por litro de aire espirado.',
            'correct_answer' => 'answer_c',
            'unit_id' => '2',
        ]);

        DB::table('questions')->insert([
            'photo_url' => 'ImagesTests/fuego.png',
            'question' => 'Cuando un vehículo accidentado comienza a arder, ¿qué se debe hacer primero?',
            'answer_a' => 'Apagar el fuego',
            'answer_b' => 'Sacar rápidamente a los heridos',
            'answer_c' => 'Ir a buscar ayuda',
            'correct_answer' => 'answer_b',
            'unit_id' => '2',
        ]);

        DB::table('questions')->insert([
            'photo_url' => 'ImagesTests/triangulos.png',
            'question' => '¿Está permitido colocar los triángulos de preseñalización de peligro a menos de 50 metros del vehículo averiado?',
            'answer_a' => 'Sí, a esa distancia ya son visibles.',
            'answer_b' => 'No, deben estar al menos a 100 metros.',
            'answer_c' => 'No.',
            'correct_answer' => 'answer_c',
            'unit_id' => '2',
        ]);

        DB::table('questions')->insert([
            'photo_url' => 'ImagesTests/detencion.png',
            'question' => '¿Qué es una detención?',
            'answer_a' => 'La inmovilización del vehículo por necesidades de la circulación.',
            'answer_b' => 'Una parada por cualquier causa.',
            'answer_c' => 'Un estacionamiento sin bajarse del vehículo.',
            'correct_answer' => 'answer_a',
            'unit_id' => '3',
        ]);

        DB::table('questions')->insert([
            'photo_url' => 'ImagesTests/airbag.png',
            'question' => 'El funcionamiento del airbag,¿puede llegar a ser peligroso en un accidente?',
            'answer_a' => 'Sí, siempre',
            'answer_b' => 'Sí, si no se lleva puesto el cinturón de seguridad.',
            'answer_c' => 'No.',
            'correct_answer' => 'answer_b',
            'unit_id' => '3',
        ]);

        DB::table('questions')->insert([
            'photo_url' => 'ImagesTests/alcohol.png',
            'question' => 'La tasa máxima de alcoholemia permitada en sagre para conductores profesionales es...',
            'answer_a' => '0,30 gramos por litro.',
            'answer_b' => '0,30 miligramos por litro',
            'answer_c' => '0,50 gramos por litro.',
            'correct_answer' => 'answer_a',
            'unit_id' => '3',
        ]);
    }
}
