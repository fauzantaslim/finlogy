<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Personal Finance' => 'Panduan dan tips mengelola keuangan pribadi untuk masa depan yang lebih baik.',
            'Investasi' => 'Berbagai instrumen investasi dari pemula hingga profesional.',
            'Kripto' => 'Kabar terbaru dan strategi mendalam seputar cryptocurrency.',
            'Saham' => 'Analisis dan rekomendasi pasar saham domestik maupun internasional.',
            'Asuransi' => 'Pentingnya proteksi dari berbagai pilihan asuransi keluarga dan bisnis.',
            'Properti' => 'Informasi investasi properti, perumahan, dan real estate.',
            'Perbankan' => 'Layanan, produk finansial, dan pembaruan dari dunia perbankan.',
        ];

        foreach ($categories as $name => $description) {
            \App\Models\Category::firstOrCreate(
                ['name' => $name],
                [
                    'slug' => \Illuminate\Support\Str::slug($name),
                    'description' => $description,
                    'is_visible' => true,
                ]
            );
        }
    }
}
