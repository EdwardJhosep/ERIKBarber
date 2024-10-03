<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;

class AppointmentSeeder extends Seeder
{
    public function run()
    {
        $timeSlots = [
            '09:00 - 10:00',
            '10:00 - 11:00',
            '11:00 - 12:00',
            '12:00 - 13:00',
            '13:00 - 14:00',
            '14:00 - 15:00',
            '15:00 - 16:00',
            '16:00 - 17:00',
            '17:00 - 18:00',
            '18:00 - 19:00',
            '19:00 - 20:00',
            '20:00 - 21:00',
        ];

        foreach ($timeSlots as $timeSlot) {
            Appointment::create([
                'time_slot' => $timeSlot,
                'barber_1_available' => true,
                'barber_2_available' => true,
                'status' => 'Pendiente', // Cambia esto a 'Aprobada' según sea necesario
            ]);
        }
    }
}