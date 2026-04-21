@extends('layouts.app')

@section('content')

    <x-breadcrumbs :links="[
        ['label' => 'Penafian (Disclaimer)'],
    ]" />

    <article class="mx-auto w-full max-w-4xl pb-24">
        <header class="mb-12 border-b-2 border-[var(--color-bg-secondary)] pb-8">
            <h1 class="text-4xl font-black leading-tight tracking-tight text-[var(--color-text-primary)] md:text-5xl">Penafian <span class="opacity-30">(Disclaimer)</span></h1>
            <p class="mt-4 text-sm font-semibold text-[var(--color-text-secondary)] opacity-60">Pembaruan Terakhir: 1 Januari 2026</p>
        </header>

        <div class="prose prose-lg max-w-none prose-headings:font-black prose-headings:text-[var(--color-text-primary)] prose-p:text-[var(--color-text-secondary)] prose-p:opacity-80 prose-a:text-[var(--color-accent-primary)] prose-a:no-underline hover:prose-a:text-[var(--color-accent-secondary)]">
            <p>Jika Anda memerlukan informasi lebih lanjut atau memiliki pertanyaan tentang penafian di blog ini, jangan ragu untuk menghubungi saya melalui e-mail ke alamat kontak yang tersedia.</p>

            <h2>Penafian untuk Finlogy</h2>
            <p>Semua informasi di blog ini &ndash; finlogy.id &ndash; diterbitkan dengan itikad baik dan untuk tujuan informasi umum serta referensi literasi semata. Sebagai pengelola tunggal, saya tidak memberikan jaminan mutlak tentang kelengkapan, keandalan, dan keakuratan informasi ini.</p>
            
            <p>Segala tindakan yang Anda lakukan atas informasi yang ditemukan di blog ini merupakan risiko Anda sendiri. Saya sangat menyarankan agar Anda mengonsultasikan keputusan keuangan kompleks Anda kepada pakar berlisensi resmi. Finlogy tidak bertanggung jawab atas kerugian sehubungan dengan penggunaan informasi dari blog ini.</p>

            <h2>Tautan Eksternal</h2>
            <p>Dari situs web kami, Anda mungkin dapat mengunjungi situs web lain dengan mengikuti hyperlink ke situs web eksternal tersebut. Meskipun kami berusaha keras untuk hanya menyediakan tautan berkualitas ke situs web yang bermanfaat dan etis, kami tidak memiliki kendali atas konten dan sifat situs-situs tersebut.</p>

            <p>Tautan ini ke situs web lain tidak menyiratkan rekomendasi untuk semua konten yang ditemukan di situs tersebut. Pemilik dan konten situs dapat berubah tanpa pemberitahuan dan mungkin terjadi sebelum kami memiliki kesempatan untuk menghapus tautan yang mungkin telah menjadi 'buruk'.</p>

            <h2>Persetujuan</h2>
            <p>Dengan menggunakan situs web kami, Anda dengan ini menyetujui penafian kami dan menyetujui ketentuan-ketentuannya.</p>

            <h2>Pembaruan</h2>
            <p>Dalam persentase di mana kami memperbarui, mengubah atau membuat perubahan apa pun pada dokumen ini, perubahan tersebut akan diposting secara jelas di sini.</p>
        </div>
    </article>

@endsection
