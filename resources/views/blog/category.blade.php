@extends('layouts.app')

@section('content')

    <x-breadcrumbs :links="[
        ['label' => 'Kategori'],
        ['label' => $category->name],
    ]" />

    {{-- 1. Category Header --}}
    <header class="mb-14">
        <div class="mb-3 flex items-center gap-3">
            <span class="h-px w-8 bg-[var(--color-accent-secondary)]"></span>
            <p class="text-[10px] font-black uppercase tracking-[0.25em] text-[var(--color-accent-secondary)]">Arsip Kategori</p>
        </div>
        <h1 class="text-4xl font-black tracking-tight text-[var(--color-text-primary)] md:text-5xl lg:text-6xl">{{ $category->name }}</h1>
        @if($category->description)
            <p class="mt-6 max-w-3xl text-sm leading-relaxed text-[var(--color-text-secondary)] opacity-70 md:text-base">{{ $category->description }}</p>
        @endif
    </header>

    @if($posts->isEmpty())
        <div class="rounded-3xl border border-[var(--color-border)] bg-[var(--color-bg-secondary)] opacity-30 py-20 text-center">
            <p class="text-sm font-medium text-[var(--color-text-secondary)] opacity-50 italic">Belum ada artikel di kategori ini.</p>
            <a href="{{ route('blog.home') }}" class="mt-6 inline-block text-sm font-bold text-[var(--color-accent-primary)] hover:underline">Kembali ke Beranda</a>
        </div>
    @else
    {{-- 2. MAIN GRID --}}
    <div class="lg:grid lg:grid-cols-[1fr_320px] lg:gap-12 lg:items-start">
        <div class="space-y-12">
            @php $allPosts = $posts->items(); $featuredPost = $posts->currentPage() === 1 ? array_shift($allPosts) : null; @endphp

            @if($featuredPost)
                <a href="{{ route('blog.post.show', [$category->slug, $featuredPost->slug]) }}"
                   class="group relative block overflow-hidden rounded-3xl transition-all duration-500 hover:shadow-2xl hover:shadow-[var(--color-accent-primary)]/20">
                    <div class="relative flex min-h-[300px] flex-col justify-end bg-[var(--color-accent-primary)] p-8 md:min-h-[400px] md:p-12">
                        @if($cover = $featuredPost->getFirstMediaUrl('post_covers'))
                            <img src="{{ $cover }}" alt="{{ $featuredPost->title }}" fetchpriority="high"
                                 class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                        
                        <div class="relative max-w-2xl">
                            <div class="mb-4 flex items-center gap-3">
                                <span class="rounded-full bg-[var(--color-accent-secondary)] px-3 py-0.5 text-[9px] font-black uppercase tracking-widest text-[var(--color-accent-primary)]">Utama</span>
                                <time class="text-[10px] font-bold uppercase tracking-widest text-white opacity-60">
                                    {{ optional($featuredPost->published_at)->translatedFormat('d F Y') }}
                                </time>
                            </div>
                            <h2 class="mb-4 text-2xl font-black leading-tight tracking-tight md:text-3xl lg:text-4xl text-white transition-colors group-hover:text-[var(--color-accent-secondary)]">
                                {{ $featuredPost->title }}
                            </h2>
                            <p class="mb-6 line-clamp-2 text-sm leading-relaxed text-white opacity-70">
                                {{ $featuredPost->excerpt }}
                            </p>
                            <span class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-[var(--color-accent-secondary)]">
                                Baca Artikel
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
            @endif

            <div class="space-y-8 divide-y divide-[var(--color-border)]">
                @foreach($allPosts as $post)
                    <article class="group grid gap-6 pt-8 first:pt-0 md:grid-cols-[200px_1fr]">
                        @if($thumb = $post->getFirstMediaUrl('post_covers'))
                            <a href="{{ route('blog.post.show', [$category->slug, $post->slug]) }}" 
                               class="block aspect-[4/3] overflow-hidden rounded-2xl border border-[var(--color-border)]">
                                <img src="{{ $thumb }}" alt="{{ $post->title }}" loading="lazy" decoding="async"
                                     class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                            </a>
                        @else
                            <div class="aspect-[4/3] rounded-2xl bg-[var(--color-bg-secondary)] opacity-10 flex items-center justify-center border border-[var(--color-border)]">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-8 w-8 text-[var(--color-text-secondary)] opacity-10" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                            </div>
                        @endif

                        <div class="flex flex-col py-1">
                            <time class="mb-2 text-[10px] font-bold uppercase tracking-widest text-[var(--color-text-secondary)] opacity-70">
                                {{ optional($post->published_at)->translatedFormat('d M Y') }}
                            </time>
                            <h3 class="mb-3 text-xl font-bold leading-tight tracking-tight text-[var(--color-text-primary)] group-hover:text-[var(--color-accent-primary)] transition-colors">
                                <a href="{{ route('blog.post.show', [$category->slug, $post->slug]) }}" class="no-underline">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <p class="mb-5 line-clamp-2 text-sm leading-relaxed text-[var(--color-text-secondary)] opacity-70">
                                {{ $post->excerpt }}
                            </p>
                            <div class="mt-auto flex items-center gap-2 text-[11px] font-semibold text-[var(--color-text-secondary)] opacity-70">
                                <span>{{ $post->user?->name }}</span>
                                <span>&middot;</span>
                                <span>{{ number_format($post->views_count) }} Views</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            <x-pagination :paginator="$posts" />
        </div>

        <aside class="mt-16 lg:mt-0 sticky top-24">
            <div class="h-full space-y-12">
                @if($recentPosts->isNotEmpty())
                <div>
                    <h3 class="mb-6 flex items-center gap-3 text-xs font-black uppercase tracking-[0.25em] text-[var(--color-accent-secondary)]">
                        <span class="h-px w-8 bg-[var(--color-accent-secondary)]"></span>
                        Terbaru
                    </h3>
                    <div class="space-y-6">
                        @foreach($recentPosts->take(5) as $r)
                            <a href="{{ route('blog.post.show', [$category->slug, $r->slug]) }}" 
                               class="group flex items-center gap-4 no-underline">
                                <div class="relative h-[56px] w-[74px] shrink-0 overflow-hidden rounded-lg bg-[var(--color-border)] opacity-40">
                                    @if($rCover = $r->getFirstMediaUrl('post_covers', 'thumb'))
                                        <img src="{{ $rCover }}" alt="{{ $r->title }}" loading="lazy" decoding="async" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110">
                                    @endif
                                </div>
                                <div>
                                    <p class="text-[13px] font-bold leading-tight text-[var(--color-text-primary)] transition-colors group-hover:text-[var(--color-accent-primary)]">
                                        {{ $r->title }}
                                    </p>
                                    <time class="mt-1.5 block text-[9px] font-bold uppercase tracking-widest text-[var(--color-text-secondary)] opacity-60">
                                        {{ optional($r->published_at)->translatedFormat('d M Y') }}
                                    </time>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </aside>
    </div>
    @endif

@endsection
