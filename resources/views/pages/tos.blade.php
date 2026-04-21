@extends('layouts.app')

@section('content')

    <x-breadcrumbs :links="[
        ['label' => 'Syarat & Ketentuan'],
    ]" />

    <article class="mx-auto w-full max-w-4xl pb-24">
        <header class="mb-12 border-b-2 border-[var(--color-bg-secondary)] pb-8">
            <h1 class="text-4xl font-black leading-tight tracking-tight text-[var(--color-text-primary)] md:text-5xl">Syarat & Ketentuan</h1>
            <p class="mt-4 text-sm font-semibold text-[var(--color-text-secondary)] opacity-60">Pembaruan Terakhir: 1 Januari 2026</p>
        </header>

        <div class="prose prose-lg max-w-none prose-headings:font-black prose-headings:text-[var(--color-text-primary)] prose-p:text-[var(--color-text-secondary)] prose-p:opacity-80 prose-li:text-[var(--color-text-secondary)] prose-li:opacity-80 prose-a:text-[var(--color-accent-primary)] prose-a:no-underline hover:prose-a:text-[var(--color-accent-secondary)]">
            <p>Selamat datang di Finlogy!</p>
            <p>Syarat dan ketentuan ini menguraikan aturan dan pedoman untuk penggunaan blog Finlogy, yang terletak di alamat finlogy.id.</p>
            <p>Dengan mengakses blog ini, saya menganggap Anda menerima syarat dan ketentuan ini secara penuh. Jangan terus menggunakan Finlogy jika Anda tidak setuju untuk mematuhi semua syarat dan ketentuan yang tercantum di halaman ini.</p>

            <h2>Hukum yang Berlaku dan Kekayaan Intelektual</h2>
            <p>Kecuali dinyatakan lain, saya selaku pemilik Finlogy memiliki hak kekayaan intelektual atas semua materi di sini. Semua hak tersebut dilindungi. Anda dapat mengakses materi dari Finlogy untuk penggunaan pribadi yang tunduk pada batasan yang diatur dalam syarat dan ketentuan ini.</p>
            <p>Anda tidak boleh:</p>
            <ul>
                <li>Menerbitkan ulang salinan editorial mentah atau materi dari Finlogy tanpa menyebut sumber.</li>
                <li>Menjual, menyewakan, atau mensublisensikan materi dari Finlogy.</li>
                <li>Memproduksi ulang, menggandakan, atau menjiplak materi eksklusif dari Finlogy.</li>
                <li>Mendistribusikan ulang konten redaksional di luar batasan kewajaran tanpa tautan perujuk asli.</li>
            </ul>

            <h2>Komentar Pengguna dan Interaksi Komunitas</h2>
            <p>Situs Web ini mungkin menawarkan kesempatan bagi pengguna untuk memposting dan bertukar pendapat serta informasi di area tertentu. Finlogy tidak memfilter, mengedit, menerbitkan, atau meninjau Komentar sebelum keberadaannya di situs web. Komentar tidak mencerminkan pandangan dan pendapat Finlogy, agen dan/atau afiliasinya.</p>
            <p>Sejauh diizinkan oleh undang-undang yang berlaku, Finlogy tidak akan bertanggung jawab atas Komentar atau segala bentuk kewajiban, kerusakan atau pengeluaran yang disebabkan dan/atau diderita sebagai akibat dari penggunaan dan/atau pengeposan dan/atau penampilan Komentar di situs web ini.</p>
            <p>Anda menjamin dan menyatakan bahwa:</p>
            <ul>
                <li>Anda berhak memposting Komentar di situs web kami dan memiliki semua lisensi serta persetujuan yang diperlukan.</li>
                <li>Komentar tidak melanggar hak kekayaan intelektual mana pun, termasuk tetapi tidak terbatas pada hak cipta, paten, atau merek dagang milik pihak ketiga mana pun.</li>
                <li>Komentar tidak mengandung materi memfitnah, menyinggung, tidak senonoh, atau melanggar hukum yang merupakan pelanggaran privasi.</li>
            </ul>

            <h2>Penghapusan Konten</h2>
            <p>Kami memiliki hak tunggal untuk meninjau, mengelola, dan menonaktifkan komentar, konten kiriman, atau akses pengguna yang kami laporkan telah melanggar salah satu Syarat &amp; Ketentuan di atas tanpa kewajiban kompensasi.</p>
        </div>
    </article>

@endsection
