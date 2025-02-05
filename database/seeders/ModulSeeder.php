<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moduls = [
            [
                'name' => 'Tes Potensi Skolastik (TPS)',
                'childs' => ['Penalaran Umum', 'Pengetahuan dan Pemahaman Umum', 'Kemampuan Memahami Bacaan dan Menulis', 'Pengetahuan Kuantitatif '],
            ],
            [
                'name' => 'Tes Literasi',
                'childs' => ['Literasi Bahasa Indonesia', 'Literasi Bahasa Inggris', 'Penalaran Matematika'],
            ],
        ];

        foreach ($moduls as $modulPayload) {
            $modul = \App\Models\Modul::create([
                'slug' => \Str::slug($modulPayload['name']),
                'name' => $modulPayload['name'],
            ]);

            foreach ($modulPayload['childs'] as $child) {
                $modul->childs()->create([
                    'slug' => \Str::slug($child),
                    'name' => $child,
                ]);
            }
        }
    }
}
