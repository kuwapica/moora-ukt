<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kriterias')->insert([
            [
                'kode' => 'C1',
                'nama' => 'Gaji Ayah',
                'bobot' => 0.125,
                'jenis' => 'cost',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C2',
                'nama' => 'Gaji Ibu',
                'bobot' => 0.125,
                'jenis' => 'cost',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C3',
                'nama' => 'Pekerjaan Ayah',
                'bobot' => 0.1,
                'jenis' => 'cost',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C4',
                'nama' => 'Pekerjaan Ibu',
                'bobot' => 0.1,
                'jenis' => 'cost',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C5',
                'nama' => 'Jumlah Tanggungan',
                'bobot' => 0.1,
                'jenis' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C6',
                'nama' => 'Tagihan PBB',
                'bobot' => 0.1,
                'jenis' => 'cost',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C7',
                'nama' => 'Tagihan Listrik dan Air',
                'bobot' => 0.1,
                'jenis' => 'cost',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C8',
                'nama' => 'Pajak Kendaraan',
                'bobot' => 0.1,
                'jenis' => 'cost',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C9',
                'nama' => 'IPK',
                'bobot' => 0.15,
                'jenis' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
