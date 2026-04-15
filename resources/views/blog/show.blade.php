@extends('layouts.app')

@section('content')

    <div class="mx-auto max-w-7xl">
        <x-breadcrumbs :links="array_filter([
            $post->category ? ['label' => $post->category->name, 'url' => route('blog.category', $post->category->slug)] : null,
            ['label' => $post->title],
        ])" />

        <div class="lg:grid lg:grid-cols-[1fr_320px] lg:gap-12">

            {{-- MAIN ARTICLE COLUMN --}}
            <article>
                {{-- Meta --}}
                <div class="mb-5 flex flex-wrap items-center gap-x-3 gap-y-1.5">
                    @if($post->category)
                        <a href="{{ route('blog.category', $post->category->slug) }}"
                           class="rounded-sm bg-[var(--color-accent-primary)] px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-widest text-[var(--color-bg-primary)] no-underline hover:bg-[var(--color-accent-secondary)] hover:text-[var(--color-accent-primary)] transition-colors">
                            {{ $post->category->name }}
                        </a>
                    @endif
                    <time class="text-xs font-medium text-[var(--color-text-secondary)]/60">
                        {{ optional($post->published_at)->translatedFormat('d F Y') }}
                    </time>
                </div>

                {{-- Title --}}
                <h1 class="mb-6 text-3xl font-black leading-tight tracking-tight text-[var(--color-text-primary)] md:text-5xl">
                    {{ $post->title }}
                </h1>

                {{-- Author bar --}}
                <div class="mb-10 flex items-center gap-3 border-y border-[var(--color-border)] py-4">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[var(--color-accent-primary)] text-sm font-bold text-[var(--color-bg-primary)]">
                        {{ Str::upper(Str::substr($post->user?->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="flex flex-wrap items-baseline gap-x-2 gap-y-0.5 text-xs text-[var(--color-text-secondary)]/70">
                        <span class="font-bold text-[var(--color-text-primary)] text-sm">{{ $post->user?->name }}</span>
                        <span>&middot;</span>
                        <span>{{ number_format($post->views_count) }} kali dibaca</span>
                    </div>
                </div>

                {{-- Cover Image --}}
                @if($cover = $post->getFirstMediaUrl('post_covers'))
                    <figure class="mb-10">
                        <img src="{{ $cover }}" alt="{{ $post->title }}"
                             class="w-full rounded-2xl border border-[var(--color-border)] object-cover shadow-sm">
                    </figure>
                @endif

                {{-- Content with Baca Juga injection --}}
                @php
                    $bacaJugaHtml = '';
                    if($relatedPosts->isNotEmpty()) {
                        $relatedList = '';
                        foreach($relatedPosts->take(2) as $relatedPost) {
                            $url = route('blog.post.show', [$relatedPost->category?->slug ?? 'umum', $relatedPost->slug]);
                            $img = $relatedPost->getFirstMediaUrl('post_covers');
                            $imgHtml = $img
                                ? '<img src="'.$img.'" alt="'.$relatedPost->title.'" class="m-0 h-[76px] w-[100px] flex-shrink-0 rounded-lg object-cover">'
                                : '<div class="m-0 h-[76px] w-[100px] flex-shrink-0 rounded-lg bg-[var(--color-border)]/50"></div>';
                            $title = htmlspecialchars($relatedPost->title);
                            $relatedList .= '<a href="'.$url.'" class="group/bj flex items-center gap-4 no-underline">'.$imgHtml.'<span class="text-sm font-bold leading-snug text-[var(--color-text-primary)] transition-colors group-hover/bj:text-[var(--color-accent-primary)]">'.$title.'</span></a>';
                        }
                        $bacaJugaHtml = '
                            <div class="not-prose my-10 rounded-2xl border border-[var(--color-border)] bg-[var(--color-bg-secondary)]/40 p-6 font-sans">
                                <p class="mb-4 text-[10px] font-black uppercase tracking-[0.25em] text-[var(--color-accent-secondary)]">Baca Juga</p>
                                <div class="flex flex-col gap-5">'.$relatedList.'</div>
                            </div>';

                        $content = $post->content;
                        if (substr_count($content, '</p>') >= 2) {
                            $content = preg_replace('/(.*?<\/p>.*?<\/p>)/s', '$1' . $bacaJugaHtml, $content, 1);
                        } else {
                            $content .= $bacaJugaHtml;
                        }
                    } else {
                        $content = $post->content;
                    }
                @endphp

                <div class="prose max-w-none leading-relaxed
                    prose-headings:font-black prose-headings:tracking-tight prose-headings:text-[var(--color-text-primary)]
                    prose-p:text-[var(--color-text-secondary)] prose-p:leading-8 prose-p:mb-6
                    prose-strong:text-[var(--color-text-primary)]
                    prose-a:text-[var(--color-accent-secondary)] prose-a:no-underline hover:prose-a:underline
                    prose-blockquote:border-l-[var(--color-accent-secondary)] prose-blockquote:bg-[var(--color-bg-secondary)]/30 prose-blockquote:py-2 prose-blockquote:px-6 prose-blockquote:rounded-r-xl prose-blockquote:not-italic prose-blockquote:text-[var(--color-text-primary)]
                    prose-li:text-[var(--color-text-secondary)]
                    md:prose-lg">
                    {!! $content !!}
                </div>

                {{-- Tags --}}
                @if($post->tags->isNotEmpty())
                    <div class="mt-12 flex flex-wrap gap-2 border-t border-[var(--color-border)] pt-8">
                        @foreach($post->tags as $tag)
                            <a href="{{ route('blog.tag', $tag->slug) }}"
                               class="rounded-full border border-[var(--color-border)] bg-white/50 px-4 py-1.5 text-xs font-medium text-[var(--color-text-secondary)] no-underline transition-all hover:border-[var(--color-accent-secondary)] hover:bg-[var(--color-accent-secondary)] hover:text-[var(--color-accent-primary)]">
                                #{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                @endif

                {{-- Terbaru Lainnya Section (Inside Grid Column) --}}
                @if($latestPosts->isNotEmpty())
                    <div class="mt-20 border-t border-[var(--color-border)] pt-16">
                        <div class="mb-10 flex items-center justify-between">
                            <div>
                                <h2 class="text-2xl font-black tracking-tight text-[var(--color-text-primary)] md:text-3xl">Artikel Terbaru <span class="text-[var(--color-accent-secondary)]">Lainnya</span></h2>
                            </div>
                        </div>

                        <div class="space-y-10">
                            @foreach($latestPosts as $lPost)
                                <article class="group grid gap-6 md:grid-cols-[240px_1fr]">
                                    <a href="{{ route('blog.post.show', [$lPost->category?->slug ?? 'umum', $lPost->slug]) }}" class="relative block aspect-video overflow-hidden rounded-2xl border border-[var(--color-border)] shadow-sm">
                                        @if($lCover = $lPost->getFirstMediaUrl('post_covers', 'thumb'))
                                            <img src="{{ $lCover }}" alt="{{ $lPost->title }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center bg-[var(--color-border)]/20 text-[10px] font-bold uppercase tracking-widest text-[var(--color-text-secondary)]/20">Finlogy</div>
                                        @endif
                                    </a>
                                    <div class="flex flex-col py-1">
                                        <div class="mb-3 flex items-center gap-3">
                                            @if($lPost->category)
                                                <span class="text-[10px] font-black uppercase tracking-widest text-[var(--color-accent-primary)]">{{ $lPost->category->name }}</span>
                                            @endif
                                            <span class="text-[10px] font-bold uppercase tracking-widest text-[var(--color-text-secondary)]/30">{{ optional($lPost->published_at)->translatedFormat('d M Y') }}</span>
                                        </div>
                                        <h3 class="mb-3 text-xl font-black leading-tight text-[var(--color-accent-primary)] ">
                                            <a href="{{ route('blog.post.show', [$lPost->category?->slug ?? 'umum', $lPost->slug]) }}" class="no-underline">{{ $lPost->title }}</a>
                                        </h3>
                                        <p class="mb-5 line-clamp-2 text-sm leading-relaxed text-[var(--color-text-secondary)]/70">
                                            {{ $lPost->excerpt }}
                                        </p>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif
            </article>

            {{-- SIDEBAR COLUMN --}}
            <aside class="mt-12 lg:mt-0">
                <div class="h-full space-y-12">

                    {{-- Related in Category --}}
                    @if($relatedPosts->isNotEmpty())
                    <div>
                        <h3 class="mb-6 border-b-2 border-[var(--color-accent-secondary)] pb-2 text-xs font-black uppercase tracking-widest text-[var(--color-text-primary)]">
                            {{ $post->category?->name ?? 'Berita' }} <span class="text-accent-secondary">Lainnya</span>
                        </h3>
                        <div class="divide-y divide-[var(--color-border)]">
                            @foreach($relatedPosts as $r)
                                <a href="{{ route('blog.post.show', [$r->category?->slug ?? 'umum', $r->slug]) }}"
                                   class="group flex items-center gap-3 py-4 no-underline first:pt-0">
                                    {{-- Thumb --}}
                                    <div class="relative h-[60px] w-[80px] shrink-0 overflow-hidden rounded-lg bg-[var(--color-border)]/50">
                                        @if($rCover = $r->getFirstMediaUrl('post_covers', 'thumb'))
                                            <img src="{{ $rCover }}" alt="{{ $r->title }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center bg-[var(--color-border)]/20 text-[6px] font-bold uppercase tracking-tighter text-[var(--color-text-secondary)]/20">Finlogy</div>
                                        @endif
                                    </div>
                                    <div class="flex min-w-0 flex-col">
                                        <p class="mb-1.5 line-clamp-2 text-[0.8rem] font-bold leading-tight text-[var(--color-text-primary)] transition-colors group-hover:text-[var(--color-accent-primary)]">
                                            {{ $r->title }}
                                        </p>
                                        <time class="text-[9px] font-bold uppercase tracking-wider text-[var(--color-text-secondary)]/40">
                                            {{ optional($r->published_at)->translatedFormat('d M Y') }}
                                        </time>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Popular Posts (Sticky) --}}
                    @if($popularPosts->isNotEmpty())
                    <div class="sticky top-24">
                        <h3 class="mb-6 border-b-2 border-[var(--color-accent-secondary)] pb-2 text-xs font-black uppercase tracking-widest text-[var(--color-text-primary)]">
                            Blog <span class="text-accent-secondary">Terpopuler</span>
                        </h3>
                        <div class="space-y-4">
                            @foreach($popularPosts as $i => $pop)
                                <a href="{{ route('blog.post.show', [$pop->category?->slug ?? 'umum', $pop->slug]) }}"
                                   class="group flex items-start gap-3 no-underline">
                                    <span class="mt-0.5 shrink-0 text-xl font-black leading-none text-[var(--color-accent-secondary)]/20 transition-colors group-hover:text-[var(--color-accent-secondary)]">
                                        {{ $i + 1 }}
                                    </span>
                                    {{-- Mini Thumb for Popular --}}
                                    <div class="relative h-[44px] w-[58px] shrink-0 overflow-hidden rounded bg-[var(--color-border)]/40">
                                        @if($pCover = $pop->getFirstMediaUrl('post_covers', 'thumb'))
                                            <img src="{{ $pCover }}" alt="{{ $pop->title }}" class="h-full w-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                                        @else
                                            <div class="h-full w-full bg-[var(--color-border)]/10"></div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="line-clamp-2 text-[0.75rem] font-bold leading-tight text-[var(--color-text-primary)] transition-colors group-hover:text-[var(--color-accent-primary)]">
                                            {{ $pop->title }}
                                        </p>
                                        <div class="mt-1 flex items-center gap-2 text-[8px] font-bold uppercase tracking-widest text-[var(--color-text-secondary)]/30">
                                            <span>{{ optional($pop->published_at)->translatedFormat('d M Y') }}</span>
                                            <span>&middot;</span>
                                            <span>{{ number_format($pop->views_count) }} Views</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                </div>
            </aside>
        </div>
    </div>

@endsection
