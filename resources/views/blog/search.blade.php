@extends('layouts.app')

@section('content')

    <x-breadcrumbs :links="[
        ['label' => 'Pencarian'],
        ['label' => $query ?? 'Hasil'],
    ]" />

    {{-- Search Header --}}
    <header class="mb-10 border-b border-[var(--color-border)] pb-8">
        <p class="mb-2 text-[10px] font-bold uppercase tracking-[0.25em] text-[var(--color-accent-secondary)]">Hasil Pencarian</p>
        <h1 class="text-3xl font-black tracking-tight text-[var(--color-text-primary)] md:text-4xl">
            "{{ $query }}"
        </h1>
        <p class="mt-4 text-sm text-[var(--color-text-secondary)]/60">
            Menampilkan {{ $posts->total() }} artikel yang cocok dengan kata kunci Anda.
        </p>
    </header>

    {{-- Articles Grid --}}
    <section class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @forelse($posts as $post)
            <article class="group flex flex-col overflow-hidden rounded-xl border border-[var(--color-border)] bg-white/50 transition-all duration-200 hover:-translate-y-0.5 hover:border-[var(--color-accent-secondary)] hover:shadow-md hover:shadow-[var(--color-accent-secondary)]/10">

                {{-- Thumbnail --}}
                @if($thumb = $post->getFirstMediaUrl('post_covers'))
                    <a href="{{ route('blog.post.show', [$post->category?->slug ?? 'umum', $post->slug]) }}" class="block overflow-hidden">
                        <img src="{{ $thumb }}" alt="{{ $post->title }}"
                             class="h-44 w-full object-cover transition-transform duration-300 group-hover:scale-105">
                    </a>
                @else
                    <div class="flex h-36 items-center justify-center bg-gradient-to-br from-[var(--color-accent-primary)]/8 to-[var(--color-border)]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[var(--color-text-secondary)]/15" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </div>
                @endif

                <div class="flex flex-1 flex-col p-5">
                    <div class="mb-3 flex items-center gap-2">
                        @if($post->category)
                            <a href="{{ route('blog.category', $post->category->slug) }}"
                               class="rounded-sm bg-[var(--color-accent-primary)]/8 px-2 py-0.5 text-[10px] font-bold uppercase tracking-widest text-[var(--color-accent-primary)] no-underline transition-colors hover:bg-[var(--color-accent-primary)] hover:text-[var(--color-bg-primary)]">
                                {{ $post->category->name }}
                            </a>
                        @endif
                        <time class="text-[11px] text-[var(--color-text-secondary)]/50" datetime="{{ $post->published_at?->toDateString() }}">
                            {{ optional($post->published_at)->translatedFormat('d M Y') }}
                        </time>
                    </div>
                    <h2 class="mb-2.5 line-clamp-2 text-[1rem] font-bold leading-snug tracking-tight text-[var(--color-text-primary)] transition-colors group-hover:text-[var(--color-accent-primary)]">
                        {{ $post->title }}
                    </h2>
                    <p class="mb-4 line-clamp-3 flex-1 text-sm leading-relaxed text-[var(--color-text-secondary)]/80">
                        {{ $post->excerpt }}
                    </p>
                    <div class="flex items-center justify-between border-t border-[var(--color-border)]/50 pt-4">
                        <span class="text-[11px] text-[var(--color-text-secondary)]/50">{{ $post->user?->name }}</span>
                        <a href="{{ route('blog.post.show', [$post->category?->slug ?? 'umum', $post->slug]) }}"
                           class="inline-flex items-center gap-1 text-xs font-semibold text-[var(--color-accent-primary)] no-underline transition-colors hover:text-[var(--color-accent-secondary)]">
                            Baca
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full py-12 text-center">
                <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-[var(--color-bg-secondary)] text-[var(--color-accent-primary)]/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-[var(--color-text-primary)]">Tidak ada hasil ditemukan</h3>
                <p class="mt-1 text-sm text-[var(--color-text-secondary)]/60">Coba gunakan kata kunci lain atau periksa ejaan Anda.</p>
                <a href="{{ route('blog.home') }}" class="mt-6 inline-block rounded-lg bg-[var(--color-accent-primary)] px-6 py-2 text-sm font-bold text-[var(--color-bg-primary)] no-underline transition-opacity hover:opacity-90">
                    Kembali ke Beranda
                </a>
            </div>
        @endforelse
    </section>

    <div class="mt-12">
        <x-pagination :paginator="$posts" />
    </div>

@endsection
