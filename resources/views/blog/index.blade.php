@extends('layouts.app')

@section('content')

    {{-- 1. HERO: Featured Post --}}
    @if($featuredPost)
    <section class="mb-14">
        <a href="{{ route('blog.post.show', [$featuredPost->category?->slug ?? 'umum', $featuredPost->slug]) }}"
           class="group relative block overflow-hidden rounded-3xl text-[var(--color-bg-primary)] transition-all duration-500 hover:shadow-2xl hover:shadow-[var(--color-accent-primary)]/20">

            {{-- Background with Featured Image and Overlay --}}
            <div class="relative flex min-h-[340px] flex-col justify-end bg-[var(--color-accent-primary)] p-8 md:min-h-[480px] md:p-16">
                @if($featuredCover = $featuredPost->getFirstMediaUrl('post_covers'))
                    <img src="{{ $featuredCover }}" alt="{{ $featuredPost->title }}"
                         class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                @endif
                {{-- Dark Gradient Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                
                <div class="relative max-w-3xl">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="rounded-full bg-[var(--color-accent-secondary)] px-4 py-1 text-[10px] font-black uppercase tracking-[0.2em] text-[var(--color-accent-primary)]">
                            Featured Article
                        </span>
                        @if($featuredPost->category)
                            <span class="text-xs font-bold uppercase tracking-widest text-white/80">
                                {{ $featuredPost->category->name }}
                            </span>
                        @endif
                    </div>
                    <h1 class="mb-6 text-3xl font-black leading-[1.1] tracking-tight md:text-5xl lg:text-6xl">
                        {{ $featuredPost->title }}
                    </h1>
                    <p class="mb-8 line-clamp-2 text-base leading-relaxed text-white/70 md:text-lg">
                        {{ $featuredPost->excerpt }}
                    </p>
                    <div class="flex items-center gap-4 text-xs font-medium text-white/50">
                        <div class="flex items-center gap-2">
                            <div class="h-6 w-6 rounded-full bg-white/20 flex items-center justify-center text-[10px] font-bold text-white uppercase">
                                {{ Str::substr($featuredPost->user?->name ?? 'A', 0, 1) }}
                            </div>
                            <span>{{ $featuredPost->user?->name }}</span>
                        </div>
                        <span>&bull;</span>
                        <span>{{ optional($featuredPost->published_at)->translatedFormat('d F Y') }}</span>
                    </div>
                </div>
            </div>
        </a>
    </section>
    @endif

    {{-- 2. MAIN GRID: Latest Articles --}}
    <div class="max-w-7xl mx-auto">
        
        {{-- Content Area --}}
        <div class="space-y-12">
            <section>
                <div class="mb-8 flex items-end justify-between border-b border-[var(--color-border)] pb-4">
                    <div>
                        <p class="mb-1 text-[10px] font-bold uppercase tracking-[0.25em] text-[var(--color-accent-secondary)]">Pembaruan Terbaru</p>
                        <h2 class="text-2xl font-bold tracking-tight text-[var(--color-text-primary)] md:text-3xl">Artikel Terbaru</h2>
                    </div>
                </div>

                <div class="space-y-8">
                    @forelse($latestPosts as $post)
                        <article class="group grid gap-6 md:grid-cols-[240px_1fr]">
                            {{-- Thumbnail --}}
                            @if($thumb = $post->getFirstMediaUrl('post_covers'))
                                <a href="{{ route('blog.post.show', [$post->category?->slug ?? 'umum', $post->slug]) }}" 
                                   class="block aspect-[4/3] overflow-hidden rounded-2xl border border-[var(--color-border)]">
                                    <img src="{{ $thumb }}" alt="{{ $post->title }}"
                                         class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                                </a>
                            @else
                                <div class="aspect-[4/3] rounded-2xl bg-gradient-to-br from-[var(--color-accent-primary)]/5 to-[var(--color-border)] flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[var(--color-text-secondary)]/10" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                </div>
                            @endif

                            {{-- Info --}}
                            <div class="flex flex-col py-1">
                                <div class="mb-3 flex items-center gap-3">
                                    @if($post->category)
                                        <a href="{{ route('blog.category', $post->category->slug) }}"
                                           class="text-[10px] font-black uppercase tracking-widest text-[var(--color-accent-primary)] no-underline hover:text-[var(--color-accent-secondary)]">
                                            {{ $post->category->name }}
                                        </a>
                                    @endif
                                    <span class="text-[10px] text-[var(--color-text-secondary)]/40 uppercase font-bold tracking-widest">
                                        {{ optional($post->published_at)->translatedFormat('d M Y') }}
                                    </span>
                                </div>
                                <h3 class="mb-3 text-xl font-bold leading-tight tracking-tight text-[var(--color-text-primary)] group-hover:text-[var(--color-accent-primary)] transition-colors">
                                    <a href="{{ route('blog.post.show', [$post->category?->slug ?? 'umum', $post->slug]) }}" class="no-underline">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <p class="mb-5 line-clamp-2 text-sm leading-relaxed text-[var(--color-text-secondary)]/70">
                                    {{ $post->excerpt }}
                                </p>
                                <div class="mt-auto flex items-center gap-2 text-[11px] font-semibold text-[var(--color-text-secondary)]/40">
                                    <span>{{ $post->user?->name }}</span>
                                    <span>&middot;</span>
                                    <span>{{ number_format($post->views_count) }} tayangan</span>
                                </div>
                            </div>
                        </article>
                    @empty
                        <p class="text-center py-10 text-[var(--color-text-secondary)]/50 italic">Belum ada artikel terbaru.</p>
                    @endforelse
                </div>
            </section>
        </div>

    </div>

@endsection
