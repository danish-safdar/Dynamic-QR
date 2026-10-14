<?php

namespace Database\Seeders;

use App\Models\Standee;
use Illuminate\Database\Seeder;

class StandeeSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 50; $i++) {
            Standee::firstOrCreate(
                ['code' => "s{$i}"],
                ['name' => "Standee {$i}", 'destination_url' => 'https://google.com']
            );
        }
    }
}