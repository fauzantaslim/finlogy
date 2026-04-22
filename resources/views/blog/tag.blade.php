@extends('layouts.app')

@section('content')

    <x-breadcrumbs :links="[
        ['label' => 'Tag'],
        ['label' => $tag->name],
    ]" />

    <header class="mb-14">
        <div class="mb-3 flex items-center gap-3">
            <span class="h-px w-8 bg-[var(--color-accent-secondary)]"></span>
            <p class="text-[10px] font-black uppercase tracking-[0.25em] text-[var(--color-accent-secondary)]">Arsip Tag</p>
        </div>
        <h1 class="text-4xl font-black tracking-tight text-[var(--color-text-primary)] md:text-5xl lg:text-6xl">
            <span class="text-[var(--color-accent-secondary)] opacity-30">#</span>{{ $tag->name }}
        </h1>
    </header>

    @if($posts->isEmpty())
        <div class="rounded-3xl border border-[var(--color-border)] bg-[var(--color-bg-secondary)] opacity-30 py-20 text-center">
            <p class="text-sm font-medium text-[var(--color-text-secondary)] opacity-50 italic">Belum ada artikel dengan tag ini.</p>
            <a href="{{ route('blog.home') }}" class="mt-6 inline-block text-sm font-bold text-[var(--color-accent-primary)] hover:underline">Kembali ke Beranda</a>
        </div>
    @else
    <div class="lg:grid lg:grid-cols-[1fr_320px] lg:gap-12">
        <div class="space-y-8 divide-y divide-[var(--color-border)]">
            @foreach($posts as $post)
                <article class="group grid gap-6 pt-8 first:pt-0 md:grid-cols-[240px_1fr]">
                    @if($thumb = $post->getFirstMediaUrl('post_covers', 'thumb'))
                        <a href="{{ route('blog.post.show', [$post->category?->slug ?? 'umum', $post->slug]) }}" 
                           class="block aspect-video overflow-hidden rounded-2xl border border-[var(--color-border)]">
                            <img src="{{ $thumb }}" alt="{{ $post->title }}" loading="lazy" decoding="async"
                                 class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                        </a>
                    @else
                        <div class="aspect-video rounded-2xl bg-[var(--color-bg-secondary)] opacity-30 flex items-center justify-center border border-[var(--color-border)]">
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-8 w-8 text-[var(--color-text-secondary)] opacity-50" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </div>
                    @endif

                    <div class="flex flex-col py-1">
                        <div class="mb-2 flex items-center gap-3">
                            @if($post->category)
                                <a href="{{ route('blog.category', $post->category->slug) }}"
                                   class="rounded-sm bg-accent-primary px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-widest text-bg-primary no-underline hover:bg-accent-secondary hover:text-accent-primary transition-colors">
                                    {{ $post->category->name }}
                                </a>
                            @endif
                            <time class="text-[10px] font-bold uppercase tracking-widest text-[var(--color-text-secondary)] opacity-70">
                                {{ optional($post->published_at)->translatedFormat('d M Y') }}
                            </time>
                        </div>
                        <h3 class="mb-3 text-xl font-bold leading-tight tracking-tight text-[var(--color-text-primary)] group-hover:text-[var(--color-accent-primary)] transition-colors">
                            <a href="{{ route('blog.post.show', [$post->category?->slug ?? 'umum', $post->slug]) }}" class="no-underline">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <p class="mb-5 line-clamp-2 text-sm leading-relaxed text-[var(--color-text-secondary)] opacity-70">
                            {{ $post->excerpt }}
                        </p>
                        <div class="mt-auto flex items-center gap-2 text-xs font-semibold text-[var(--color-text-secondary)] opacity-70">
                            <span>Author: {{ $post->user?->name }}</span>
                        </div>
                    </div>
                </article>
            @endforeach

            <div class="pt-10">
                <x-pagination :paginator="$posts" />
            </div>
        </div>

        <aside class="mt-16 lg:mt-0">
            <div class="h-full space-y-12">
                @if(isset($popularPosts) && $popularPosts->isNotEmpty())
                <div class="sticky top-24">
                    <h3 class="mb-6 flex items-center gap-3 text-xs font-black uppercase tracking-[0.25em] text-[var(--color-accent-secondary)]">
                        <span class="h-px w-8 bg-[var(--color-accent-secondary)]"></span>
                        Terpopuler
                    </h3>
                    <div class="space-y-5">
                        @foreach($popularPosts->take(5) as $i => $pop)
                            <a href="{{ route('blog.post.show', [$pop->category?->slug ?? 'umum', $pop->slug]) }}" 
                               class="group flex items-start gap-4 no-underline">
                                <span class="text-2xl font-black italic text-[var(--color-accent-primary)] opacity-10 transition-colors group-hover:text-[var(--color-accent-secondary)] group-hover:opacity-30">
                                    {{ $i + 1 }}
                                </span>
                                <div class="relative h-[48px] w-[64px] shrink-0 overflow-hidden rounded-lg bg-[var(--color-border)] opacity-40">
                                    @if($pCover = $pop->getFirstMediaUrl('post_covers', 'thumb'))
                                        <img src="{{ $pCover }}" alt="{{ $pop->title }}" loading="lazy" decoding="async" class="h-full w-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                                    @endif
                                </div>
                                <div>
                                    <p class="text-[0.8rem] font-bold leading-tight text-[var(--color-text-primary)] transition-colors group-hover:text-[var(--color-accent-primary)]">
                                        {{ $pop->title }}
                                    </p>
                                    <p class="mt-1.5 text-[9px] font-bold tracking-widest text-[var(--color-text-secondary)] opacity-60 uppercase">
                                        {{ number_format($pop->views_count) }} Views
                                    </p>
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
