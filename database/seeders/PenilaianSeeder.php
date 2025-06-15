<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenilaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data penilaian berdasarkan tabel yang diberikan pada dokumen
        $penilaians = [
            // (A1)
            ['alternatif_id' => 1, 'kriteria_id' => 1, 'nilai' => 2], // C1 - 
            ['alternatif_id' => 1, 'kriteria_id' => 2, 'nilai' => 2], // C2 - 
            ['alternatif_id' => 1, 'kriteria_id' => 3, 'nilai' => 3], // C3 - 
            ['alternatif_id' => 1, 'kriteria_id' => 4, 'nilai' => 4], // C4 - 
            ['alternatif_id' => 1, 'kriteria_id' => 5, 'nilai' => 3], // C5 - 
            ['alternatif_id' => 1, 'kriteria_id' => 6, 'nilai' => 1], // C6 - 
            ['alternatif_id' => 1, 'kriteria_id' => 7, 'nilai' => 2], // C7 - 
            ['alternatif_id' => 1, 'kriteria_id' => 8, 'nilai' => 3], // C8 -
            ['alternatif_id' => 1, 'kriteria_id' => 9, 'nilai' => 3], // C9 - 

            // (A2)
            ['alternatif_id' => 2, 'kriteria_id' => 1, 'nilai' => 5], // C1 - 
            ['alternatif_id' => 2, 'kriteria_id' => 2, 'nilai' => 1], // C2 - 
            ['alternatif_id' => 2, 'kriteria_id' => 3, 'nilai' => 5], // C3 - 
            ['alternatif_id' => 2, 'kriteria_id' => 4, 'nilai' => 1], // C4 - 
            ['alternatif_id' => 2, 'kriteria_id' => 5, 'nilai' => 2], // C5 - 
            ['alternatif_id' => 2, 'kriteria_id' => 6, 'nilai' => 2], // C6 - 
            ['alternatif_id' => 2, 'kriteria_id' => 7, 'nilai' => 2], // C7 - 
            ['alternatif_id' => 2, 'kriteria_id' => 8, 'nilai' => 2], // C8 -
            ['alternatif_id' => 2, 'kriteria_id' => 9, 'nilai' => 2], // C9 - 

            // (A3)
            ['alternatif_id' => 3, 'kriteria_id' => 1, 'nilai' => 6], // C1 - 
            ['alternatif_id' => 3, 'kriteria_id' => 2, 'nilai' => 4], // C2 - 
            ['alternatif_id' => 3, 'kriteria_id' => 3, 'nilai' => 6], // C3 - 
            ['alternatif_id' => 3, 'kriteria_id' => 4, 'nilai' => 5], // C4 - 
            ['alternatif_id' => 3, 'kriteria_id' => 5, 'nilai' => 5], // C5 - 
            ['alternatif_id' => 3, 'kriteria_id' => 6, 'nilai' => 1], // C6 - 
            ['alternatif_id' => 3, 'kriteria_id' => 7, 'nilai' => 1], // C7 - 
            ['alternatif_id' => 3, 'kriteria_id' => 8, 'nilai' => 1], // C8 - 
            ['alternatif_id' => 3, 'kriteria_id' => 9, 'nilai' => 1], // C9 - 

            // (A4)
            ['alternatif_id' => 4, 'kriteria_id' => 1, 'nilai' => 1], // C1 - 
            ['alternatif_id' => 4, 'kriteria_id' => 2, 'nilai' => 6], // C2 - 
            ['alternatif_id' => 4, 'kriteria_id' => 3, 'nilai' => 1], // C3 - 
            ['alternatif_id' => 4, 'kriteria_id' => 4, 'nilai' => 5], // C4 - 
            ['alternatif_id' => 4, 'kriteria_id' => 5, 'nilai' => 4], // C5 - 
            ['alternatif_id' => 4, 'kriteria_id' => 6, 'nilai' => 5], // C6 - 
            ['alternatif_id' => 4, 'kriteria_id' => 7, 'nilai' => 4], // C7 - 
            ['alternatif_id' => 4, 'kriteria_id' => 8, 'nilai' => 4], // C8 -
            ['alternatif_id' => 4, 'kriteria_id' => 9, 'nilai' => 4], // C9 -

            // (A5)
            ['alternatif_id' => 5, 'kriteria_id' => 1, 'nilai' => 1], // C1 - 
            ['alternatif_id' => 5, 'kriteria_id' => 2, 'nilai' => 1], // C2 - 
            ['alternatif_id' => 5, 'kriteria_id' => 3, 'nilai' => 1], // C3 - 
            ['alternatif_id' => 5, 'kriteria_id' => 4, 'nilai' => 1], // C4 - 
            ['alternatif_id' => 5, 'kriteria_id' => 5, 'nilai' => 5], // C5 - 
            ['alternatif_id' => 5, 'kriteria_id' => 6, 'nilai' => 1], // C6 - 
            ['alternatif_id' => 5, 'kriteria_id' => 7, 'nilai' => 1], // C7 - 
            ['alternatif_id' => 5, 'kriteria_id' => 8, 'nilai' => 4], // C8 - 
            ['alternatif_id' => 5, 'kriteria_id' => 9, 'nilai' => 5], // C9 - 
        ];

        foreach ($penilaians as $penilaian) {
            // Cek apakah kombinasi alternatif_id dan kriteria_id sudah ada
            $exists = DB::table('penilaians')
                ->where('alternatif_id', $penilaian['alternatif_id'])
                ->where('kriteria_id', $penilaian['kriteria_id'])
                ->exists();

            if (!$exists) {
                DB::table('penilaians')->insert([
                    'alternatif_id' => $penilaian['alternatif_id'],
                    'kriteria_id' => $penilaian['kriteria_id'],
                    'nilai' => $penilaian['nilai'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
