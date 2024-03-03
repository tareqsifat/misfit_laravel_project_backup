<?php

namespace Database\Seeders\Seminar;

use App\Models\Seminars\SeminarParticipants;
use Illuminate\Database\Seeder;

class SeminarParticipantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        SeminarParticipants::truncate();
        SeminarParticipants::create([
            'seminar_id' => '1',
            'full_name' => 'tarikul islam',
            'email' => 'tarek@gmail.com',
            'phone_number' => '01712345466',
            'address' => 'mirpur, dhaka',

        ]);
        SeminarParticipants::create([
            'seminar_id' => '2',
            'full_name' => 'sorif islam',
            'email' => 'sorif@gmail.com',
            'phone_number' => '01712345433',
            'address' => 'mirpur, dhaka',

        ]);
        SeminarParticipants::create([
            'seminar_id' => '3',
            'full_name' => 'sajidul islam',
            'email' => 'sajidul@gmail.com',
            'phone_number' => '01712345446',
            'address' => 'jatrabari, dhaka',

        ]);
    }
}
