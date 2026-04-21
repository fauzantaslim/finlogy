@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center py-20 text-center">
    {{-- Error Code --}}
    <div class="font-serif text-[120px] font-black leading-none text-[var(--color-text-primary)] opacity-10 md:text-[200px]">
        404
    </div>

    {{-- Error Message --}}
    <div class="mt-[-40px] md:mt-[-70px]">
        <h1 class="mb-4 text-4xl font-black uppercase tracking-tighter text-[var(--color-text-primary)] sm:text-6xl">
            Halaman Hilang
        </h1>
        <div class="mx-auto mb-10 h-1.5 w-24 bg-[var(--color-accent-secondary)]"></div>
        <p class="mx-auto max-w-md text-sm leading-relaxed opacity-70 md:text-base">
            Maaf, artikel atau halaman yang Anda cari tidak dapat ditemukan. Mungkin telah dipindahkan atau dihapus dari redaksi kami.
        </p>
    </div>

    {{-- Actions --}}
    <div class="mt-12 flex flex-col gap-4 sm:flex-row">
        <a href="{{ route('blog.home') }}" 
           class="flex h-12 items-center justify-center border-2 border-[var(--color-text-primary)] bg-[var(--color-text-primary)] px-8 text-xs font-black uppercase tracking-widest text-[var(--color-bg-primary)] transition-all hover:bg-transparent hover:text-[var(--color-text-primary)]">
            Kembali ke Beranda
        </a>
        <button @click="searchOpen = true"
                class="flex h-12 items-center justify-center border-2 border-[var(--color-text-primary)] bg-transparent px-8 text-xs font-black uppercase tracking-widest text-[var(--color-text-primary)] transition-all hover:bg-[var(--color-text-primary)] hover:text-[var(--color-bg-primary)]">
            Cari Artikel Lain
        </button>
    </div>
</div>
@endsection
