<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number'); // Campo para el número de celular
            $table->timestamp('appointment_time'); // Cambiado a timestamp para guardar fecha y hora
            $table->string('appointment_type'); // Campo para el tipo de cita
            $table->string('status'); // Campo para el estado de la cita
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
