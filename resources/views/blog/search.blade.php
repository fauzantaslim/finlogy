@extends('layouts.app')

@section('content')

    <x-breadcrumbs :links="[
        ['label' => 'Pencarian'],
        ['label' => $query ?? 'Hasil'],
    ]" />

    <header class="mb-10 border-b border-[var(--color-border)] pb-8">
        <p class="mb-2 text-[10px] font-bold uppercase tracking-[0.25em] text-[var(--color-accent-secondary)]">Hasil Pencarian</p>
        <h1 class="text-3xl font-black tracking-tight text-[var(--color-text-primary)] md:text-4xl">
            "{{ $query }}"
        </h1>
        <p class="mt-4 text-sm text-[var(--color-text-secondary)] opacity-60">
            Menampilkan {{ $posts->total() }} artikel yang cocok dengan kata kunci Anda.
        </p>
    </header>

    <section class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($posts as $post)
            <article class="group flex flex-col overflow-hidden rounded-xl border-2 border-[var(--color-bg-secondary)] bg-[var(--color-bg-primary)] transition-all duration-300 hover:-translate-y-1 hover:border-[var(--color-accent-secondary)] hover:shadow-[0_12px_30px_-15px_rgba(0,0,0,0.1)] hover:shadow-[var(--color-accent-secondary)]/20">
                @if($thumb = $post->getFirstMediaUrl('post_covers'))
                    <a href="{{ route('blog.post.show', [$post->category?->slug ?? 'umum', $post->slug]) }}" class="relative block overflow-hidden aspect-[4/3] border-b-2 border-[var(--color-bg-secondary)] group-hover:border-[var(--color-accent-secondary)]/30 transition-colors">
                        <img src="{{ $thumb }}" alt="{{ $post->title }}" loading="lazy" decoding="async"
                             class="absolute inset-0 h-full w-full object-cover mix-blend-multiply opacity-90 transition-transform duration-700 group-hover:scale-105 group-hover:opacity-100">
                    </a>
                @else
                    <div class="relative flex aspect-[4/3] items-center justify-center border-b-2 border-[var(--color-bg-secondary)] bg-[var(--color-bg-secondary)]/40 transition-colors group-hover:border-[var(--color-accent-secondary)]/30">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-12 w-12 text-[var(--color-text-secondary)] opacity-20" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </div>
                @endif

                <div class="flex flex-1 flex-col p-6">
                    <div class="mb-4 flex items-center gap-3">
                        @if($post->category)
                            <a href="{{ route('blog.category', $post->category->slug) }}"
                               class="inline-flex items-center justify-center rounded-sm bg-[var(--color-accent-primary)]/10 px-2 py-0.5 text-[10px] font-bold uppercase tracking-widest text-[var(--color-accent-primary)] no-underline transition-colors hover:bg-[var(--color-accent-primary)] hover:text-[var(--color-bg-primary)]">
                                {{ $post->category->name }}
                            </a>
                        @else
                            <div class="h-4 w-12 rounded-sm bg-[var(--color-accent-primary)]/10"></div>
                        @endif
                        <time class="text-[11px] font-semibold text-[var(--color-text-secondary)] opacity-60" datetime="{{ $post->published_at?->toDateString() }}">
                            {{ optional($post->published_at)->translatedFormat('d M Y') }}
                        </time>
                    </div>
                    <h2 class="mb-3 line-clamp-2 text-xl font-bold leading-tight tracking-tight text-[var(--color-text-primary)] transition-colors group-hover:text-[var(--color-accent-primary)]">
                        {{ $post->title }}
                    </h2>
                    <p class="mb-8 line-clamp-3 flex-1 text-[13px] leading-relaxed text-[var(--color-text-secondary)] xl:text-[14px] opacity-75">
                        {{ $post->excerpt }}
                    </p>
                    <div class="mt-auto flex items-center justify-between border-t-2 border-[var(--color-bg-secondary)] pt-4 transition-colors group-hover:border-[var(--color-accent-secondary)]/20">
                        <span class="text-[11px] font-bold tracking-widest text-[var(--color-text-secondary)] opacity-50 uppercase">{{ $post->user?->name ?? 'Writer' }}</span>
                        <a href="{{ route('blog.post.show', [$post->category?->slug ?? 'umum', $post->slug]) }}"
                           class="inline-flex items-center gap-1.5 text-xs font-bold text-[var(--color-accent-primary)] no-underline transition-colors hover:text-[var(--color-accent-secondary)] group-hover:text-[var(--color-accent-secondary)]">
                            Baca
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-3.5 w-3.5 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full py-12 text-center">
                <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-[var(--color-bg-secondary)] opacity-50 text-[var(--color-accent-primary)]">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-[var(--color-text-primary)]">Tidak ada hasil ditemukan</h3>
                <p class="mt-1 text-sm text-[var(--color-text-secondary)] opacity-60">Coba gunakan kata kunci lain atau periksa ejaan Anda.</p>
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
