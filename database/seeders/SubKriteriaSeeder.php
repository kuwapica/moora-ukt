<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  (C1)
        $this->createSubKriteriasForKriteria(1, [
            ['keterangan' => 'Sangat Rendah', 'nilai' => 1],
            ['keterangan' => 'Rendah', 'nilai' => 2],
            ['keterangan' => 'Cukup', 'nilai' => 3],
            ['keterangan' => 'Sedang', 'nilai' => 4],
            ['keterangan' => 'Agak Tinggi', 'nilai' => 5],
            ['keterangan' => 'Sangat Tinggi', 'nilai' => 6],
        ]);

        // (C2)
        $this->createSubKriteriasForKriteria(2, [
            ['keterangan' => 'Sangat Rendah', 'nilai' => 1],
            ['keterangan' => 'Rendah', 'nilai' => 2],
            ['keterangan' => 'Cukup', 'nilai' => 3],
            ['keterangan' => 'Sedang', 'nilai' => 4],
            ['keterangan' => 'Agak Tinggi', 'nilai' => 5],
            ['keterangan' => 'Sangat Tinggi', 'nilai' => 6],
        ]);

        //  (C3)
        $this->createSubKriteriasForKriteria(3, [
            ['keterangan' => 'Sangat Rendah', 'nilai' => 1],
            ['keterangan' => 'Rendah', 'nilai' => 2],
            ['keterangan' => 'Cukup', 'nilai' => 3],
            ['keterangan' => 'Sedang', 'nilai' => 4],
            ['keterangan' => 'Agak Tinggi', 'nilai' => 5],
            ['keterangan' => 'Sangat Tinggi', 'nilai' => 6],
        ]);

        // (C4)
        $this->createSubKriteriasForKriteria(4, [
            ['keterangan' => 'Sangat Rendah', 'nilai' => 1],
            ['keterangan' => 'Rendah', 'nilai' => 2],
            ['keterangan' => 'Cukup', 'nilai' => 3],
            ['keterangan' => 'Sedang', 'nilai' => 4],
            ['keterangan' => 'Agak Tinggi', 'nilai' => 5],
            ['keterangan' => 'Sangat Tinggi', 'nilai' => 6],
        ]);

        // (C5)
        $this->createSubKriteriasForKriteria(5, [
            ['keterangan' => 'Sangat Buruk', 'nilai' => 1],
            ['keterangan' => 'Buruk', 'nilai' => 2],
            ['keterangan' => 'Cukup', 'nilai' => 3],
            ['keterangan' => 'Baik', 'nilai' => 4],
            ['keterangan' => 'Sangat Baik', 'nilai' => 5],
        ]);

        // (C6)
        $this->createSubKriteriasForKriteria(6, [
            ['keterangan' => 'Sangat Rendah', 'nilai' => 1],
            ['keterangan' => 'Rendah', 'nilai' => 2],
            ['keterangan' => 'Cukup', 'nilai' => 3],
            ['keterangan' => 'Sedang', 'nilai' => 4],
            ['keterangan' => 'Agak Tinggi', 'nilai' => 5],
            ['keterangan' => 'Sangat Tinggi', 'nilai' => 6],
        ]);

        // (C7)
        $this->createSubKriteriasForKriteria(7, [
            ['keterangan' => 'Sangat Rendah', 'nilai' => 1],
            ['keterangan' => 'Rendah', 'nilai' => 2],
            ['keterangan' => 'Cukup', 'nilai' => 3],
            ['keterangan' => 'Sedang', 'nilai' => 4],
            ['keterangan' => 'Agak Tinggi', 'nilai' => 5],
            ['keterangan' => 'Sangat Tinggi', 'nilai' => 6],
        ]);

        // (C8)
        $this->createSubKriteriasForKriteria(8, [
            ['keterangan' => 'Sangat Rendah', 'nilai' => 1],
            ['keterangan' => 'Rendah', 'nilai' => 2],
            ['keterangan' => 'Sedang', 'nilai' => 3],
            ['keterangan' => 'Agak Tinggi', 'nilai' => 4],
            ['keterangan' => 'Sangat Tinggi', 'nilai' => 5],
        ]);

        // (C9)
        $this->createSubKriteriasForKriteria(9, [
            ['keterangan' => 'Sangat Buruk', 'nilai' => 1],
            ['keterangan' => 'Buruk', 'nilai' => 2],
            ['keterangan' => 'Cukup', 'nilai' => 3],
            ['keterangan' => 'Baik', 'nilai' => 4],
            ['keterangan' => 'Sangat Baik', 'nilai' => 5],
        ]);
    }

    /**
     * Helper function to create sub kriterias for a kriteria
     */
    private function createSubKriteriasForKriteria($kriteria_id, $subKriterias)
    {
        foreach ($subKriterias as $subKriteria) {
            DB::table('sub_kriterias')->insert([
                'kriteria_id' => $kriteria_id,
                'keterangan' => $subKriteria['keterangan'],
                'nilai' => $subKriteria['nilai'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
