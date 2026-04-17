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
                    @php $thumb = $post->getFirstMediaUrl('post_covers'); @endphp
                    <a href="{{ route('blog.post.show', [$post->category?->slug ?? 'umum', $post->slug]) }}"
                       class="group relative block flex-1 overflow-hidden rounded-2xl bg-[var(--color-accent-primary)] min-h-[200px] sm:min-h-[220px]">
                        @if($thumb)
                            <img src="{{ $thumb }}" alt="{{ $post->title }}"
                                 class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                        <div class="absolute inset-0 flex flex-col justify-end p-4">
                            @if($post->category)
                                <span class="mb-1.5 inline-block text-[9px] font-black uppercase tracking-[0.2em] text-[var(--color-accent-secondary)]">
                                    {{ $post->category->name }}
                                </span>
                            @endif
                            <span class="mb-1 block text-[9px] font-semibold text-white/50">
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
                    @php $featuredCover = $featuredPost->getFirstMediaUrl('post_covers'); @endphp
                    <a href="{{ route('blog.post.show', [$featuredPost->category?->slug ?? 'umum', $featuredPost->slug]) }}"
                       class="group relative block h-full overflow-hidden rounded-2xl bg-[var(--color-accent-primary)] min-h-[420px] sm:min-h-[500px] lg:min-h-0">
                        @if($featuredCover)
                            <img src="{{ $featuredCover }}" alt="{{ $featuredPost->title }}"
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
                            <span class="mb-2 block text-[9px] font-semibold text-white/50">
                                {{ optional($featuredPost->published_at)->diffForHumans() }}
                            </span>
                            <h2 class="mb-3 text-xl font-black leading-tight tracking-tight text-white group-hover:text-[var(--color-accent-secondary)] transition-colors md:text-2xl lg:text-3xl">
                                {{ $featuredPost->title }}
                            </h2>
                            <p class="line-clamp-2 text-xs leading-relaxed text-white/60 md:text-sm">
                                {{ $featuredPost->excerpt }}
                            </p>
                        </div>
                    </a>
                @endif
            </div>

            {{-- RIGHT COLUMN --}}
            <div class="flex flex-col gap-1.5 lg:row-span-2 lg:h-full">
                @if($heroRight->isNotEmpty())
                    @php $rightFirst = $heroRight->first(); $thumbR1 = $rightFirst->getFirstMediaUrl('post_covers'); @endphp
                    <a href="{{ route('blog.post.show', [$rightFirst->category?->slug ?? 'umum', $rightFirst->slug]) }}"
                       class="group relative block overflow-hidden rounded-2xl bg-[var(--color-accent-primary)] min-h-[200px] sm:min-h-[260px] lg:flex-[3] lg:min-h-0">
                        @if($thumbR1)
                            <img src="{{ $thumbR1 }}" alt="{{ $rightFirst->title }}"
                                 class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute inset-0 flex flex-col justify-end p-4 md:p-5">
                            @if($rightFirst->category)
                                <span class="mb-1.5 inline-block text-[9px] font-black uppercase tracking-[0.2em] text-[var(--color-accent-secondary)]">
                                    {{ $rightFirst->category->name }}
                                </span>
                            @endif
                            <span class="mb-1 block text-[9px] font-semibold text-white/50">
                                {{ optional($rightFirst->published_at)->diffForHumans() }}
                            </span>
                            <h3 class="text-sm font-bold leading-tight text-white line-clamp-3 group-hover:text-[var(--color-accent-secondary)] transition-colors md:text-base">
                                {{ $rightFirst->title }}
                            </h3>
                        </div>
                    </a>

                    @if($heroRight->count() > 1)
                        @php $rightSecond = $heroRight->get(1); $thumbR2 = $rightSecond->getFirstMediaUrl('post_covers'); @endphp
                        <a href="{{ route('blog.post.show', [$rightSecond->category?->slug ?? 'umum', $rightSecond->slug]) }}"
                           class="group relative block overflow-hidden rounded-2xl bg-[var(--color-accent-primary)] min-h-[180px] sm:min-h-[200px] lg:flex-[2]">
                            @if($thumbR2)
                                <img src="{{ $thumbR2 }}" alt="{{ $rightSecond->title }}"
                                     class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            <div class="absolute inset-0 flex flex-col justify-end p-4">
                                @if($rightSecond->category)
                                    <span class="mb-1.5 inline-block text-[9px] font-black uppercase tracking-[0.2em] text-[var(--color-accent-secondary)]">
                                        {{ $rightSecond->category->name }}
                                    </span>
                                @endif
                                <span class="mb-1 block text-[9px] font-semibold text-white/50">
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

    {{-- 2. MAIN GRID: Latest Articles --}}
    <div class="max-w-7xl mx-auto">
        <div class="space-y-12">
            <section>
                <div class="mb-8 flex items-end justify-between border-b border-[var(--color-border)] pb-4">
                    <div>
                        <h2 class="text-2xl font-bold tracking-tight text-[var(--color-text-primary)] md:text-3xl">Artikel Terbaru</h2>
                    </div>
                </div>

                <div class="space-y-8">
                    @forelse($remainingPosts as $post)
                        <article class="group grid gap-6 md:grid-cols-[240px_1fr]">
                            @if($thumb = $post->getFirstMediaUrl('post_covers'))
                                <a href="{{ route('blog.post.show', [$post->category?->slug ?? 'umum', $post->slug]) }}"
                                   class="block aspect-[4/3] overflow-hidden rounded-2xl border border-[var(--color-border)]">
                                    <img src="{{ $thumb }}" alt="{{ $post->title }}"
                                         class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                                </a>
                            @else
                                <div class="aspect-[4/3] rounded-2xl bg-[var(--color-bg-secondary)] opacity-10 flex items-center justify-center border border-[var(--color-border)]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[var(--color-text-secondary)] opacity-10" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                </div>
                            @endif

                            <div class="flex flex-col py-1">
                                <div class="mb-3 flex items-center gap-3">
                                    @if($post->category)
                                        <a href="{{ route('blog.category', $post->category->slug) }}"
                                           class="text-[10px] font-black uppercase tracking-widest text-[var(--color-accent-primary)] no-underline hover:text-[var(--color-accent-secondary)]">
                                            {{ $post->category->name }}
                                        </a>
                                    @endif
                                    <span class="text-[10px] text-[var(--color-text-secondary)] opacity-40 uppercase font-bold tracking-widest">
                                        {{ optional($post->published_at)->translatedFormat('d M Y') }}
                                    </span>
                                </div>
                                <h3 class="mb-3 text-xl font-bold leading-tight tracking-tight text-[var(--color-text-primary)] group-hover:text-[var(--color-accent-primary)] transition-colors">
                                    <a href="{{ route('blog.post.show', [$post->category?->slug ?? 'umum', $post->slug]) }}" class="no-underline">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <p class="mb-5 line-clamp-2 text-sm leading-relaxed text-[var(--color-text-secondary)] opacity-70">
                                    {{ $post->excerpt }}
                                </p>
                                <div class="mt-auto flex items-center gap-2 text-[11px] font-semibold text-[var(--color-text-secondary)] opacity-40">
                                    <span>{{ $post->user?->name }}</span>
                                    <span>&middot;</span>
                                    <span>{{ number_format($post->views_count) }} tayangan</span>
                                </div>
                            </div>
                        </article>
                    @empty
                        <p class="text-center py-10 text-[var(--color-text-secondary)] opacity-50 italic">Belum ada artikel terbaru.</p>
                    @endforelse
                </div>
            </section>
        </div>
    </div>

@endsection
