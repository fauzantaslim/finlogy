@extends('layouts.app')

@section('content')

    <x-breadcrumbs :links="[
        ['label' => 'Privacy Policy'],
    ]" />

    <article class="mx-auto w-full max-w-4xl pb-24">
        <header class="mb-12 border-b-2 border-[var(--color-bg-secondary)] pb-8">
            <h1 class="text-4xl font-black leading-tight tracking-tight text-[var(--color-text-primary)] md:text-5xl">Kebijakan Privasi</h1>
            <p class="mt-4 text-sm font-semibold text-[var(--color-text-secondary)] opacity-60">Pembaruan Terakhir: 1 Januari 2026</p>
        </header>

        <div class="prose prose-lg max-w-none prose-headings:font-black prose-headings:text-[var(--color-text-primary)] prose-p:text-[var(--color-text-secondary)] prose-p:opacity-80 prose-a:text-[var(--color-accent-primary)] prose-a:no-underline hover:prose-a:text-[var(--color-accent-secondary)]">
            <p>Di Finlogy, yang dapat diakses dari finlogy.id, salah satu prioritas utama saya adalah privasi pengunjung. Dokumen Kebijakan Privasi ini berisi jenis informasi yang dikumpulkan dan dicatat oleh sistem blog ini dan bagaimana saya menggunakannya.</p>
            
            <p>Jika Anda memiliki pertanyaan tambahan atau memerlukan informasi lebih lanjut tentang Kebijakan Privasi di blog ini, jangan ragu untuk menghubungi saya.</p>

            <h2>File Log</h2>
            <p>Finlogy mengikuti prosedur standar dalam menggunakan file log. File-file ini mencatat riwayat pengunjung ketika mereka mengunjungi situs web. Semua perusahaan hosting melakukan ini dan merupakan bagian dari analitik layanan hosting. Informasi yang dikumpulkan oleh file log termasuk alamat protokol internet (IP), tipe browser, Penyedia Layanan Internet (ISP), perincian tanggal dan waktu, halaman perujuk/keluar, dan mungkin jumlah klik. Informasi ini tidak ditautkan ke data pribadi apa pun. Tujuan informasi ini adalah untuk menganalisis tren, mengelola situs, melacak pergerakan pengguna, dan mengumpulkan informasi demografis.</p>

            <h2>Cookies dan Web Beacons</h2>
            <p>Seperti situs web lainnya, Finlogy menggunakan 'cookies'. Cookie ini digunakan untuk menyimpan informasi termasuk preferensi pengunjung, dan halaman pada situs web yang diakses atau dikunjungi pengunjung. Informasi tersebut digunakan untuk mengoptimalkan pengalaman pengguna dengan menyesuaikan konten halaman web kami berdasarkan jenis browser pengunjung dan/atau informasi lainnya.</p>

            <h2>Hak Privasi (Sesuai Regulasi Terkait)</h2>
            <p>Berdasarkan landasan hukum perlindungan privasi yang berlaku, konsumen memiliki hak antara lain:</p>
            <ul>
                <li>Meminta bisnis yang mengumpulkan data pribadi konsumen mengungkapkan kategori dan rincian spesifik data pribadi yang dikumpulkan bisnis tentang konsumen.</li>
                <li>Meminta penghapusan data pribadi apa pun tentang konsumen yang telah dikumpulkan.</li>
            </ul>
            <p>Jika Anda mengajukan permintaan perlindungan atau penghapusan, kami memiliki waktu satu bulan untuk menanggapi Anda. Jika Anda ingin melaksanakan salah satu dari hak-hak ini, silakan hubungi kami.</p>

            <h2>Persetujuan</h2>
            <p>Dengan menggunakan situs web kami, Anda dengan ini menyetujui Kebijakan Privasi kami dan menyetujui syarat-syaratnya.</p>
        </div>
    </article>

@endsection
