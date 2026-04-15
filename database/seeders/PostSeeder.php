<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $writer = \App\Models\User::where('email', 'writer@finlogy.loc')->first();
        $editor = \App\Models\User::where('email', 'editor@finlogy.loc')->first();

        if (!$writer || !$editor) {
            $writer = \App\Models\User::first();
            $editor = \App\Models\User::first();
        }

        $postDataList = [
            'Personal Finance' => [
                'Cara Mengatur Gaji UMR Agar Tetap Bisa Menabung dan Investasi Tiap Bulan',
                'Rahasia Bebas Finansial di Usia 30-an yang Jarang Dibahas Perencana Keuangan',
                'Mengapa Dana Darurat Lebih Penting dari Investasi Apapun Saat Ini',
                '5 Kebiasaan Kecil yang Membuat Anda Selalu Kehabisan Uang di Akhir Bulan',
                'Strategi Frugal Living Menghadapi Resesi Tanpa Mengorbankan Gaya Hidup',
                'Panduan Lengkap Melunasi Hutang KPR dan Pinjol Dalam Waktu Singkat',
                'Kesalahan Finansial Terbesar di Usia 20-an yang Menghancurkan Masa Tua',
                'Cara Membagi Pos Pengeluaran 50/30/20 yang Sebenarnya Berlaku di Indonesia',
                'Apakah Menyewa Rumah Lebih Menguntungkan Daripada Membeli? Ini Hitungannya',
                'Mental Miskin vs Mental Kaya: Ubah Mindset Anda Sebelum Mengubah Saldo Bank',
            ],
            'Investasi' => [
                'Instrumen Investasi Rendah Risiko Terbaik Tahun Ini untuk Pemula',
                'Jangan Mulai Investasi Sebelum Anda Paham 3 Konsep Fundamental Ini',
                'Reksadana vs Emas: Mana Pengaman Kekayaan Terbaik Saat Inflasi Meroket?',
                'Misteri Bunga Majemuk: Rahasia Albert Einstein Melipatgandakan Kekayaan',
                'Cara Mulai Investasi Hanya dengan Rp 100.000 dan Tumbuh Menjadi Jutaan',
                'Diversifikasi Portofolio Ala Miliarder yang Bisa Diterapkan Investor Ritel',
                'Awas Bodong! Ciri-ciri Investasi Ilegal yang Kerap Memakan Korban',
                'Panduan Membaca Prospektus Reksadana Seperti Seorang Profesional',
                'Sukuk Ritel dan SBR: Menjadi Investor Sekaligus Membantu Negara',
                'Mengidentifikasi Profil Risiko Anda Sebelum Market Menguji Mental Anda',
            ],
            'Kripto' => [
                'Mengenal Bitcoin dan Siklus Halving Dibalik Lompatan Harga Bersejarahnya',
                'Web3 dan Masa Depan Internet: Mengapa Institusi Besar Mulai Masuk ke Kripto',
                'Cara Mengamankan Aset Kripto Anda di Cold Wallet Agar Kebal dari Hacker',
                'Jangan FOMO! Panduan Membaca Sentimen Pasar Kripto Bagi Pemula',
                'Ethereum 2.0 dan Ekosistem Layer 2 yang Akan Mengubah Wajah DeFi',
                'Altcoin Season: Strategi Menemukan Permata Tersembunyi di Pasar Bearish',
                'Membongkar Mitos Bahwa Kripto Hanya Sekedar Alat Spekulasi',
                'Panduan Staking Kripto: Cara Menghasilkan Passive Income Sambil Tidur',
                'Anatomi Sebuah Bull Run Kripto dan Kapan Anda Harus Mengambil Profit',
                'Regulasi Kripto Global dan Dampaknya Pada Bursa Lokal di Indonesia',
            ],
            'Saham' => [
                'Cara Memulai Investasi Saham dengan Modal Kecil Namun Strategi Raksasa',
                'Analisis Fundamental vs Teknikal: Madzhab Mana yang Akan Membuat Anda Kaya?',
                'Membaca Laporan Keuangan Saham Blue Chip dalam 10 Menit',
                'Value Investing Dibalik Kesuksesan Lo Kheng Hong dan Warren Buffett',
                'Cara Menemukan Saham "Tenbagger" yang Bisa Naik 1000 Persen',
                'Bandarmologi: Mengintai Pergerakan Institusi di Pasar Saham Domestik',
                'Strategi Deviden Investing: Pensiun Dini Hanya dari Hasil Deviden',
                'Pelajaran Pahit dari Market Crash yang Wajib Diketahui Investor Pemula',
                'Kapan Saat yang Tepat Untuk Cut Loss Tanpa Mengedepankan Ego?',
                'Menilai Harga Wajar Sebuah Saham Agar Tak Membeli Kucing Dalam Karung',
            ],
            'Asuransi' => [
                'Asuransi Unit Link vs Term Life: Bongkar Rahasia Agen yang Jarang Diceritakan',
                'Mengapa Asuransi Kesehatan Adalah Pertahanan Terakhir Kekayaan Anda',
                'Panduan Tepat Memilih BPJS Kesehatan Bersamaan dengan Asuransi Swasta',
                'Penyakit Kritis: Risiko Finansial Terdahsyat yang Menghantui Usia Produktif',
                'Cara Mengajukan Klaim Asuransi Agar Tidak Ditolak oleh Perusahaan',
                'Asuransi Pendidikan Anak: Cerdas atau Justru Merugikan Secara Inflasi?',
                'Mitos Asuransi Jiwa Bagi Generasi Milenial yang Masih Lajang',
                'Menghitung Uang Pertanggungan Ideal Agar Keluarga Tidak Terlantar',
                'Review Jujur Berbagai Produk Asuransi Tanpa Bumbu Marketing',
                'Apakah Asuransi Properti Penting Bagi Rumah Pertama Anda?',
            ],
            'Properti' => [
                'Booming Harga Tanah: Di Mana Spot Investasi Terbaik Dalam Dekade Ini?',
                'Flip Properti: Strategi Beli Rumah Rusak dan Jual Mahal a La Developer',
                'KPR Subsidi vs Komersial: Panduan Mendapatkan Bunga Paling Masuk Akal',
                'Membeli Rumah di Tengah Suku Bunga Tinggi, Apakah Sebuah Blunder?',
                'Investasi Kost-Kostan: Hitungan Riil Modal, Pajak, dan Balik Modal',
                'Apartemen vs Rumah Tapak: Pertarungan ROI Bagi Investor Jangka Panjang',
                'Cara Bernegosiasi Cerdas Saat Membeli Rumah Bekas',
                'Legalitas Properti: Pahami SHM, HGB, dan PPJB Sebelum Anda Menyesal',
                'Desain Minimalis yang Dapat Meningkatkan Nilai Jual Properti Hingga 30%',
                'Mengulik Peluang Properti di Ibu Kota Baru dan Kota Penyangganya',
            ],
            'Perbankan' => [
                'Perang Bunga Deposito Digital: Bank Mana yang Paling Menguntungkan?',
                'Pahami Bedanya Bunga Flat, Anuitas, dan Efektif Agar Tidak Terjebak Kredit',
                'Panduan Memaksimalkan Fitur Kartu Kredit untuk Traveling Gratis',
                'Bahaya Paylater: Bom Waktu Literasi Keuangan Generasi Z',
                'Mengenal Wealth Management di Layanan Prioritas Perbankan',
                'Dampak Kenaikan Suku Bunga BI Terhadap Perekonomian Rumah Tangga',
                'Keamanan Digital Banking: Mencegah Phishing, Skimming, dan Social Engineering',
                'Membedah Laporan Keuangan Bank: Mengapa Saham Keuangan Selalu Layak Dikoleksi',
                'Inovasi Open Banking dan Masa Depan Transaksi Cashless di Indonesia',
                'Simpanan Terjamin LPS: Batas Aman yang Sering Dilupakan Konglomerat Baru',
            ],
        ];

        foreach ($postDataList as $categoryName => $titles) {
            $category = \App\Models\Category::where('name', $categoryName)->first();
            if (!$category) {
                continue;
            }

            foreach ($titles as $index => $title) {
                $status = ($index < 8) ? 'published' : 'draft';

                \App\Models\Post::firstOrCreate(
                    ['title' => $title],
                    [
                        'slug' => \Illuminate\Support\Str::slug($title),
                        'category_id' => $category->id,
                        'user_id' => ($index % 2 == 0) ? $writer->id : $editor->id,
                        'excerpt' => $this->generateExcerpt($title),
                        'content' => $this->generateEliteContent($title, $categoryName),
                        'status' => $status,
                        'published_at' => $status === 'published' ? now()->subDays(rand(1, 365))->addHours(rand(1, 24)) : null,
                        'views_count' => $status === 'published' ? rand(500, 150000) : 0,
                    ]
                );
            }
        }
    }

    private function generateExcerpt(string $title): string
    {
        return "Dalam artikel ini, kita akan membahas tuntas mengenai {$title}. Temukan strategi brilian dan metode praktis yang bisa langsung Anda terapkan hari ini untuk stabilitas finansial Anda.";
    }

    private function generateEliteContent(string $title, string $categoryName): string
    {
        $intro = "Tahukah Anda bahwa sebagian besar orang sering mengabaikan peluang besar yang tertutup oleh kebiasaan lama?";
        $callToAction = "Jangan biarkan hari ini menjadi penyesalan di masa depan. Ambil langkah tegas, rencanakan keuangan Anda, dan bangun fondasi kekayaan yang tak tergoyahkan.";

        if ($categoryName === 'Saham' || $categoryName === 'Investasi' || $categoryName === 'Kripto') {
            $intro = "Pasar selalu penuh dengan mitos fantastis. Namun sebagai investor cerdas, Anda wajib tahu mekanisme di balik setiap angka yang hijau maupun merah menyala.";
            $callToAction = "Waktu terbaik untuk memulai adalah sepuluh tahun yang lalu. Waktu terbaik kedua adalah sekarang. Evaluasi portofolio Anda hari ini.";
        }

        return <<<HTML
<div class="cms-content">
    <p class="lead" style="font-size: 1.25rem; font-weight: 500; color: #4B5563;">
        <strong>{$intro}</strong>
    </p>

    <p>Ketika membicarakan tentang <em>{$title}</em>, saya telah melihat ribuan pola—dan percayalah, mayoritas orang terjebak pada asumsi yang sama selama bertahun-tahun. Kita hidup di era informasi di mana literasi finansial bukan lagi sebuah kemewahan, melainkan <strong>kewajiban mutlak</strong> untuk bertahan hidup.</p>

    <h2>Mengapa Mengubah Perspektif Sangatlah Krusial?</h2>
    <p>Fakta pahitnya: sistem konvensional tidak selalu dirancang untuk membuat Anda merdeka secara finansial. Jika Anda terus menggunakan metodologi yang usang, mendapatkan hasil yang berbeda hanyalah fatamorgana belaka.</p>

    <blockquote>
        "Mendapatkan uang adalah satu keahlian. Menyimpan dan mengembangkannya adalah keahlian yang jauh berbeda, menuntut mentalitas dan kedisiplinan tingkat tinggi."
    </blockquote>

    <h3>3 Poin Penting yang Tidak Boleh Anda Abaikan</h3>
    <ul>
        <li><strong>Fokus pada Fundamental, Bukan Hanya Eksekusi Buta:</strong> Sebelum terjun, ketahui parameter risikonya. Anda tidak sedang berjudi; Anda sedang menata masa depan.</li>
        <li><strong>Waktu adalah Aset Paling Berharga:</strong> Bunga majemuk <em>(compound interest)</em> baru akan bekerja dengan maksimal ketika Anda memberi waktu untuk bertumbuh.</li>
        <li><strong>Kendalikan Emosi:</strong> Baik dalam urusan gaya hidup, maupun saat berhadapan dengan pasar yang tidak menentu. Ketakutan <em>(Fear)</em> dan Keserakahan <em>(Greed)</em> adalah musuh terbesar rasionalitas finansial.</li>
    </ul>

    <h2>Paradigma Baru di Sektor {$categoryName}</h2>
    <p>Mari kita breakdown lebih dalam mengenai konstelasi yang sedang terbangun. Tren menunjukkan bahwa volatilitas akan selalu hadir, namun peluang emas kerap lahir di tengah kekacauan.</p>

    <p>Langkah terbaik yang bisa Anda kerjakan dalam menyikapi fenomena ini adalah dengan menyiapkan 'bangkung penyelamat'. Jangan habiskan peluru di satu medan pertempuran. <strong>Diversifikasi</strong> pemahaman Anda dan bangun rencana cadangan.</p>

    <hr style="margin: 2rem 0; border: 1px solid #E5E7EB;" />

    <h2>Kesimpulan Akhir</h2>
    <p>Sangat mudah untuk membiarkan informasi berlalu layaknya angin. Yang membedakan antara mereka yang secara finansial <em>terseok-seok</em> dan mereka yang <em>merdeka</em> adalah <strong>tindakan nyata <em>(actionable steps)</em></strong>.</p>
    <p style="background-color: #F3F4F6; padding: 1rem; border-radius: 0.5rem; text-align: center; font-weight: bold; color: #111827;">
        👉 {$callToAction} 👈
    </p>
</div>
HTML;
    }
}
