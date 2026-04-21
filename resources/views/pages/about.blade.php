@extends('layouts.app')

@section('content')

    <x-breadcrumbs :links="[
        ['label' => 'Tentang Kami'],
    ]" />

    <article class="mx-auto w-full max-w-7xl">
        {{-- Hero Section --}}
        <header class="mb-16 md:mb-24">
            <div class="mb-4 flex items-center gap-3">
                <span class="h-px w-8 bg-[var(--color-accent-secondary)]"></span>
                <p class="text-[10px] font-black uppercase tracking-[0.25em] text-[var(--color-accent-secondary)]">Cerita kami</p>
            </div>
            
            <div class="grid gap-12 lg:grid-cols-[1fr_minmax(300px,max-content)] lg:gap-20">
                <div>
                    <h1 class="text-4xl font-black leading-tight tracking-tight text-[var(--color-text-primary)] md:text-5xl lg:text-7xl">
                        Membangun literasi finansial lewat tulisan yang bermakna.
                    </h1>
                </div>
                <div class="flex flex-col justify-end">
                    <p class="text-base leading-relaxed text-[var(--color-text-secondary)] opacity-80 md:text-lg">
                        Di Finlogy, kami mendedikasikan waktu untuk merakit wawasan mendalam seputar keuangan, teknologi, dan gaya hidup. Bukan sekadar berbagi informasi, tapi memberikan perspektif yang bisa diimplementasikan.
                    </p>
                </div>
            </div>
        </header>

        {{-- Main Feature Graphic --}}
        <figure class="mb-16 overflow-hidden rounded-3xl border border-[var(--color-border)] bg-[var(--color-bg-secondary)] shadow-sm md:mb-32">
            <div class="aspect-video w-full bg-gradient-to-tr from-[var(--color-accent-primary)] to-[#004225] flex items-center justify-center relative overflow-hidden">
                <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] mix-blend-overlay"></div>
                <div class="relative z-10 text-center">
                    <span class="text-6xl font-black italic tracking-tighter text-[var(--color-bg-primary)] opacity-90 md:text-8xl">
                        finlogy<span class="text-[var(--color-accent-secondary)]">.id</span>
                    </span>
                </div>
            </div>
        </figure>

        {{-- Core Values Grid --}}
        <section class="grid gap-12 border-t py-16 border-[var(--color-border)] md:grid-cols-3 md:gap-8 lg:py-24">
            <div class="md:col-span-1 border-b pb-8 md:border-b-0 md:pb-0 md:pr-8">
                <h2 class="text-2xl font-black tracking-tight text-[var(--color-text-primary)] lg:text-4xl">Komitmen kami</h2>
                <p class="mt-4 text-sm text-[var(--color-text-secondary)] opacity-70">Setiap artikel yang kami tulis membawa misi untuk mencerahkan dan memberdayakan pembaca.</p>
            </div>
            
            <div class="grid gap-8 md:col-span-2 md:grid-cols-2 lg:gap-12">
                {{-- Value 1 --}}
                <div class="flex flex-col">
                    <div class="mb-4 text-4xl font-black text-[var(--color-accent-secondary)] opacity-30">01</div>
                    <h3 class="mb-3 text-lg font-bold text-[var(--color-text-primary)]">Integritas Konten</h3>
                    <p class="text-sm leading-relaxed text-[var(--color-text-secondary)] opacity-80">kami menyajikan informasi berdasarkan riset yang jujur dan objektif, menjauhkan bias demi menjaga kepercayaan pembaca setia blog ini.</p>
                </div>
                {{-- Value 2 --}}
                <div class="flex flex-col">
                    <div class="mb-4 text-4xl font-black text-[var(--color-accent-secondary)] opacity-30">02</div>
                    <h3 class="mb-3 text-lg font-bold text-[var(--color-text-primary)]">Wawasan Jernih</h3>
                    <p class="text-sm leading-relaxed text-[var(--color-text-secondary)] opacity-80">Bukan sekadar berita sekilas. Tulisan kami diracang untuk memberikan pemahaman yang mendalam terhadap isu-isu finansial yang kompleks.</p>
                </div>
                {{-- Value 3 --}}
                <div class="flex flex-col">
                    <div class="mb-4 text-4xl font-black text-[var(--color-accent-secondary)] opacity-30">03</div>
                    <h3 class="mb-3 text-lg font-bold text-[var(--color-text-primary)]">Relevansi Praktis</h3>
                    <p class="text-sm leading-relaxed text-[var(--color-text-secondary)] opacity-80">kami berusaha menjadi penghubung yang mudah dipahami antara teori ekonomi dan praktik harian bagi pembaca blog ini.</p>
                </div>
                {{-- Value 4 --}}
                <div class="flex flex-col">
                    <div class="mb-4 text-4xl font-black text-[var(--color-accent-secondary)] opacity-30">04</div>
                    <h3 class="mb-3 text-lg font-bold text-[var(--color-text-primary)]">Aksesibilitas Informasi</h3>
                    <p class="text-sm leading-relaxed text-[var(--color-text-secondary)] opacity-80">Blog ini dibangun dengan standar aksesibilitas tinggi agar ilmu di dalamnya dapat diserap oleh siapa saja tanpa hambatan.</p>
                </div>
            </div>
        </section>

    </article>

@endsection
