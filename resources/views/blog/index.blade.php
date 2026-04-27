@extends('layouts.app')

@section('content')

    {{-- 1. HERO: Magazine Grid Layout --}}
    @php
        $heroSide = $latestPosts->take(4)->values();
        $heroLeft = $heroSide->take(2)->values();
        $heroRight = $heroSide->slice(2, 2)->values();
        $remainingPosts = $latestPosts->skip(4)->values();
    @endphp

    @if($featuredPost || $heroSide->isNotEmpty())
    <section class="mb-14">
        {{-- Magazine Grid --}}
        <div class="grid grid-cols-1 gap-1.5 sm:grid-cols-2 lg:grid-cols-[1fr_2fr_1fr] lg:grid-rows-2" style="min-height: 520px;">

            {{-- LEFT COLUMN --}}
            <div class="flex flex-col gap-1.5 lg:row-span-2 lg:h-full">
                @foreach($heroLeft as $post)
                    @php $thumb = $post->getFirstMediaUrl('post_covers', 'thumb'); @endphp
                    <a href="{{ route('blog.post.show', [$post->category?->slug ?? 'umum', $post->slug]) }}"
                       class="group relative block flex-1 overflow-hidden rounded-2xl bg-[var(--color-accent-primary)] min-h-[200px] sm:min-h-[220px]">
                        @if($thumb)
                            <img src="{{ $thumb }}" alt="{{ $post->title }}" fetchpriority="high"
                                 width="400" height="300"
                                 class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                        <div class="absolute inset-0 flex flex-col justify-end p-4">
                            @if($post->category)
                                <span class="mb-1.5 inline-block text-[9px] font-black uppercase tracking-[0.2em] text-[var(--color-accent-secondary)]">
                                    {{ $post->category->name }}
                                </span>
                            @endif
                            <span class="mb-1 block text-[9px] font-semibold text-white/80">
                                {{ optional($post->published_at)->diffForHumans() }}
                            </span>
                            <h3 class="text-sm font-bold leading-tight text-white line-clamp-3 group-hover:text-[var(--color-accent-secondary)] transition-colors">
                                {{ $post->title }}
                            </h3>
                        </div>
                    </a>
                @endforeach

                {{-- Placeholder --}}
                @for($i = $heroLeft->count(); $i < 2; $i++)
                    <div class="flex-1 min-h-[200px] rounded-2xl bg-[var(--color-border)] opacity-30"></div>
                @endfor
            </div>

            {{-- CENTER --}}
            <div class="lg:row-span-2">
                @if($featuredPost)
                    @php $featuredCover = $featuredPost->getFirstMediaUrl('post_covers', 'optimized'); @endphp
                    <a href="{{ route('blog.post.show', [$featuredPost->category?->slug ?? 'umum', $featuredPost->slug]) }}"
                       class="group relative block h-full overflow-hidden rounded-2xl bg-[var(--color-accent-primary)] min-h-[420px] sm:min-h-[500px] lg:min-h-0">
                        @if($featuredCover)
                            <img src="{{ $featuredCover }}" alt="{{ $featuredPost->title }}" fetchpriority="high"
                                 width="1200" height="630"
                                 class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                        <div class="absolute inset-x-0 bottom-0 p-6 md:p-8">
                            <div class="mb-3 flex flex-wrap items-center gap-2">
                                <span class="rounded-full bg-[var(--color-accent-secondary)] px-3 py-0.5 text-[9px] font-black uppercase tracking-[0.2em] text-[var(--color-accent-primary)]">
                                    Featured
                                </span>
                                @if($featuredPost->category)
                                    <span class="text-[9px] font-bold uppercase tracking-widest text-white/70">
                                        {{ $featuredPost->category->name }}
                                    </span>
                                @endif
                            </div>
                            <span class="mb-2 block text-[9px] font-semibold text-white/80">
                                {{ optional($featuredPost->published_at)->diffForHumans() }}
                            </span>
                            <h2 class="mb-3 text-xl font-black leading-tight tracking-tight text-white group-hover:text-[var(--color-accent-secondary)] transition-colors md:text-2xl lg:text-3xl">
                                {{ $featuredPost->title }}
                            </h2>
                            <p class="line-clamp-2 text-xs leading-relaxed text-white/80 md:text-sm">
                                {{ $featuredPost->excerpt }}
                            </p>
                        </div>
                    </a>
                @endif
            </div>

            {{-- RIGHT COLUMN --}}
            <div class="flex flex-col gap-1.5 lg:row-span-2 lg:h-full">
                @if($heroRight->isNotEmpty())
                    @php $rightFirst = $heroRight->first(); $thumbR1 = $rightFirst->getFirstMediaUrl('post_covers', 'thumb'); @endphp
                    <a href="{{ route('blog.post.show', [$rightFirst->category?->slug ?? 'umum', $rightFirst->slug]) }}"
                       class="group relative block overflow-hidden rounded-2xl bg-[var(--color-accent-primary)] min-h-[200px] sm:min-h-[260px] lg:flex-[3] lg:min-h-0">
                        @if($thumbR1)
                            <img src="{{ $thumbR1 }}" alt="{{ $rightFirst->title }}" fetchpriority="high"
                                 width="400" height="300"
                                 class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute inset-0 flex flex-col justify-end p-4 md:p-5">
                            @if($rightFirst->category)
                                <span class="mb-1.5 inline-block text-[9px] font-black uppercase tracking-[0.2em] text-[var(--color-accent-secondary)]">
                                    {{ $rightFirst->category->name }}
                                </span>
                            @endif
                            <span class="mb-1 block text-[9px] font-semibold text-white/80">
                                {{ optional($rightFirst->published_at)->diffForHumans() }}
                            </span>
                            <h3 class="text-sm font-bold leading-tight text-white line-clamp-3 group-hover:text-[var(--color-accent-secondary)] transition-colors md:text-base">
                                {{ $rightFirst->title }}
                            </h3>
                        </div>
                    </a>

                    @if($heroRight->count() > 1)
                        @php $rightSecond = $heroRight->get(1); $thumbR2 = $rightSecond->getFirstMediaUrl('post_covers', 'thumb'); @endphp
                        <a href="{{ route('blog.post.show', [$rightSecond->category?->slug ?? 'umum', $rightSecond->slug]) }}"
                           class="group relative block overflow-hidden rounded-2xl bg-[var(--color-accent-primary)] min-h-[180px] sm:min-h-[200px] lg:flex-[2]">
                            @if($thumbR2)
                                <img src="{{ $thumbR2 }}" alt="{{ $rightSecond->title }}" fetchpriority="high"
                                     width="400" height="300"
                                     class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            <div class="absolute inset-0 flex flex-col justify-end p-4">
                                @if($rightSecond->category)
                                    <span class="mb-1.5 inline-block text-[9px] font-black uppercase tracking-[0.2em] text-[var(--color-accent-secondary)]">
                                        {{ $rightSecond->category->name }}
                                    </span>
                                @endif
                                <span class="mb-1 block text-[9px] font-semibold text-white/80">
                                    {{ optional($rightSecond->published_at)->diffForHumans() }}
                                </span>
                                <h3 class="text-sm font-bold leading-tight text-white line-clamp-3 group-hover:text-[var(--color-accent-secondary)] transition-colors">
                                    {{ $rightSecond->title }}
                                </h3>
                            </div>
                        </a>
                    @endif
                @endif
            </div>

        </div>
    </section>
    @endif

    {{-- 2. MAIN GRID: Latest & Popular & Categories --}}
    <div class="mx-auto max-w-7xl">
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-[1fr_320px] xl:grid-cols-[1fr_380px]">

            {{-- LEFT COLUMN: LATEST & CATEGORIES --}}
            <div class="flex flex-col gap-16">

                {{-- LATEST POSTS --}}
                <section>
                    <div class="mb-8 flex items-end justify-between border-b-[6px] border-[var(--color-text-primary)] pb-4">
                        <h2 class="text-4xl font-black uppercase tracking-tighter text-[var(--color-text-primary)] sm:text-5xl">Terbaru</h2>
                    </div>

                    <div class="flex flex-col divide-y divide-[var(--color-border)] border-b border-[var(--color-border)]">
                        @forelse($remainingPosts as $post)
                            <article class="group grid gap-6 py-8 md:grid-cols-[200px_1fr] lg:grid-cols-[240px_1fr]">
                                @if($thumb = $post->getFirstMediaUrl('post_covers', 'thumb'))
                                    <a href="{{ route('blog.post.show', [$post->category?->slug ?? 'umum', $post->slug]) }}"
                                       class="block aspect-[4/3] w-full overflow-hidden border border-[var(--color-border)] transition-transform duration-300 group-hover:-translate-y-1 group-hover:shadow-[4px_4px_0_0_var(--color-text-primary)]">
                                        <img src="{{ $thumb }}" alt="{{ $post->title }}" loading="lazy" decoding="async"
                                             width="400" height="300"
                                             class="h-full w-full object-cover grayscale transition-all duration-500 group-hover:grayscale-0">
                                    </a>
                                @else
                                    <div class="flex aspect-[4/3] w-full items-center justify-center border border-[var(--color-border)] bg-[var(--color-bg-secondary)] opacity-10"></div>
                                @endif

                                <div class="flex flex-col py-1">
                                    <div class="mb-3 flex items-center gap-3">
                                        @if($post->category)
                                            <a href="{{ route('blog.category', $post->category->slug) }}"
                                               class="text-[10px] font-black uppercase tracking-widest text-[var(--color-accent-primary)] no-underline hover:underline">
                                                {{ $post->category->name }}
                                            </a>
                                        @endif
                                        <span class="text-[10px] font-bold uppercase tracking-widest text-[var(--color-text-secondary)] opacity-70">
                                            {{ optional($post->published_at)->translatedFormat('d M Y') }}
                                        </span>
                                    </div>
                                    <h3 class="mb-3 text-2xl font-black leading-tight tracking-tight text-[var(--color-text-primary)] transition-colors group-hover:text-[var(--color-accent-primary)]">
                                        <a href="{{ route('blog.post.show', [$post->category?->slug ?? 'umum', $post->slug]) }}" class="no-underline">
                                            {{ $post->title }}
                                        </a>
                                    </h3>
                                    <p class="mb-5 line-clamp-3 text-sm leading-relaxed opacity-70">
                                        {{ $post->excerpt }}
                                    </p>
                                    <div class="mt-auto flex items-center gap-2 text-[10px] font-black uppercase tracking-widest opacity-60">
                                        <span>OLEH {{ $post->user?->name ?? 'Redaksi' }}</span>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <p class="py-10 text-center text-sm font-bold uppercase tracking-widest opacity-50">Belum ada artikel terbaru.</p>
                        @endforelse
                    </div>
                </section>

                {{-- CATEGORIES BLOCK --}}
                @foreach($categoriesWithPosts as $cat)
                <section>
                    <div class="mb-8 flex items-center justify-between border-y-2 border-[var(--color-text-primary)] py-3">
                        <h2 class="text-3xl font-black uppercase tracking-tighter">{{ $cat->name }}</h2>
                        <a href="{{ route('blog.category', $cat->slug) }}" class="flex h-8 items-center border border-[var(--color-text-primary)] bg-[var(--color-text-primary)] px-4 text-[10px] font-black uppercase tracking-widest text-[var(--color-bg-primary)] transition-all hover:bg-transparent hover:text-[var(--color-text-primary)]">
                            Lihat Semua &rarr;
                        </a>
                    </div>

                    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2">
                        @foreach($cat->posts as $post)
                            <article class="group flex flex-col gap-4">
                                @if($thumb = $post->getFirstMediaUrl('post_covers', 'thumb'))
                                    <a href="{{ route('blog.post.show', [$cat->slug, $post->slug]) }}"
                                       class="block w-full aspect-[16/9] overflow-hidden border border-[var(--color-border)] transition-all duration-300 group-hover:-translate-y-1 group-hover:shadow-[4px_4px_0_0_var(--color-text-primary)]">
                                        <img src="{{ $thumb }}" alt="{{ $post->title }}" loading="lazy" decoding="async"
                                             width="400" height="300"
                                             class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                                    </a>
                                @endif
                                <div>
                                    <div class="mb-2 text-[9px] font-bold uppercase tracking-widest opacity-70">
                                        {{ optional($post->published_at)->translatedFormat('d M Y') }}
                                    </div>
                                    <h3 class="text-lg font-black leading-tight tracking-tight transition-colors group-hover:text-[var(--color-accent-primary)] md:text-xl">
                                        <a href="{{ route('blog.post.show', [$cat->slug, $post->slug]) }}" class="no-underline">
                                            {{ $post->title }}
                                        </a>
                                    </h3>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
                @endforeach

            </div>

            {{-- RIGHT COLUMN: POPULAR --}}
            <aside class="flex flex-col gap-10">
                <div class="sticky top-24">
                    <div class="mb-8 border-t-[6px] border-[var(--color-text-primary)] pt-4">
                        <h2 class="text-2xl font-black uppercase tracking-tighter md:text-3xl">Terpopuler</h2>
                    </div>

                    <div class="flex flex-col">
                        @foreach($popularPosts as $index => $post)
                            <article class="group relative flex items-start gap-4 border-b border-[var(--color-border)] py-6 pt-5 hover:bg-[var(--color-text-primary)]/5">
                                <div class="font-serif text-5xl font-black leading-none text-[var(--color-text-primary)] opacity-10 transition-opacity group-hover:opacity-30">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex flex-col pt-1">
                                    @if($post->category)
                                        <a href="{{ route('blog.category', $post->category->slug) }}"
                                           class="mb-2 text-[9px] font-black uppercase tracking-widest text-[var(--color-accent-primary)] no-underline hover:underline">
                                            {{ $post->category->name }}
                                        </a>
                                    @endif
                                    <h3 class="text-base font-bold leading-tight tracking-tight text-[var(--color-text-primary)] transition-colors group-hover:text-[var(--color-accent-primary)]">
                                        <a href="{{ route('blog.post.show', [$post->category?->slug ?? 'umum', $post->slug]) }}" class="after:absolute after:inset-0">
                                            {{ $post->title }}
                                        </a>
                                    </h3>
                                    <div class="mt-3 flex items-center gap-2 text-[9px] font-black uppercase tracking-widest opacity-60">
                                        <span>{{ number_format($post->views_count) }} TAYANGAN</span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </aside>

        </div>
    </div>

@endsection
