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
            $table->date('appointment_date'); // Campo para la fecha de la cita
            $table->time('appointment_time'); // Campo para la hora de la cita
            $table->string('appointment_type'); // Campo para el tipo de cita
            $table->string('status'); // Campo para el estado de la cita
            $table->string('fotopagocita')->nullable(); // Campo para la foto del pago de la cita, nullable si no es obligatorio
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
