<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alternatifs')->insert([
            [
                'kode' => 'A1',
                'nama' => 'Mahasiswa 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'A2',
                'nama' => 'Mahasiswa 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'A3',
                'nama' => 'Mahsiswa 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'A4',
                'nama' => 'Mahasiswa 4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'A5',
                'nama' => 'Mahasiswa 5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
