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
                           class="rounded-sm bg-accent-primary px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-widest text-bg-primary no-underline hover:bg-accent-secondary hover:text-accent-primary transition-colors">
                            {{ $post->category->name }}
                        </a>
                    @endif
                    <time class="text-xs font-medium text-text-secondary/60">
                        {{ optional($post->published_at)->translatedFormat('d F Y') }}
                    </time>
                </div>

                {{-- Title --}}
                <h1 class="mb-6 text-3xl font-black leading-tight tracking-tight text-text-primary md:text-5xl">
                    {{ $post->title }}
                </h1>

                {{-- Author bar --}}
                <div class="mb-10 flex items-center justify-between gap-3 border-y border-border py-4">
                    {{-- Author info --}}
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-accent-primary text-sm font-bold text-bg-primary">
                            {{ Str::upper(Str::substr($post->user?->name ?? 'A', 0, 1)) }}
                        </div>
                        <div class="flex flex-wrap items-baseline gap-x-2 gap-y-0.5 text-xs text-text-secondary/70">
                            <span class="font-bold text-text-primary text-sm">{{ $post->user?->name }}</span>
                            <span>&middot;</span>
                            <span>{{ number_format($post->views_count) }} kali dibaca</span>
                        </div>
                    </div>

                    {{-- Share button + dropdown --}}
                    <div class="relative" x-data="{ open: false }">
                        <button
                            @click="open = !open"
                            @click.outside="open = false"
                            :aria-expanded="open"
                            aria-label="Bagikan artikel ini"
                            title="Bagikan artikel"
                            class="flex h-9 w-9 items-center justify-center rounded-full border border-border text-text-secondary opacity-80 transition-all hover:border-accent-secondary hover:bg-accent-secondary hover:text-accent-primary hover:opacity-100"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                            </svg>
                        </button>

                        {{-- Dropdown --}}
                        <div
                            x-show="open"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                            class="absolute right-0 top-11 z-50 w-48 origin-top-right rounded-xl border border-border bg-accent-primary p-1.5 shadow-2xl shadow-black/20"
                        >
                            {{-- Twitter / X --}}
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}"
                               target="_blank" rel="noopener"
                               class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-semibold text-bg-primary no-underline transition-colors hover:bg-accent-secondary hover:text-[#004225]">
                                <svg class="h-4 w-4 shrink-0 fill-current" viewBox="0 0 24 24">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.748l7.73-8.835L1.254 2.25H8.08l4.253 5.622 5.911-5.622Zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                </svg>
                                Bagikan di X
                            </a>

                            {{-- WhatsApp --}}
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . request()->url()) }}"
                               target="_blank" rel="noopener"
                               class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-semibold text-bg-primary no-underline transition-colors hover:bg-accent-secondary hover:text-[#004225]">
                                <svg class="h-4 w-4 shrink-0 fill-current" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
                                </svg>
                                Bagikan via WA
                            </a>

                            <div class="my-1 border-t border-bg-primary/20"></div>

                            {{-- Copy Link --}}
                            <button
                                @click="navigator.clipboard.writeText('{{ request()->url() }}').then(() => { open = false; })"
                                class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm font-semibold text-bg-primary transition-colors hover:bg-accent-secondary hover:text-[#004225]">
                                <svg class="h-4 w-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                                </svg>
                                Salin Tautan
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Cover Image --}}
                @if($cover = $post->getFirstMediaUrl('post_covers'))
                    <figure class="mb-10">
                        <img src="{{ $cover }}" alt="{{ $post->title }}" fetchpriority="high"
                             class="w-full rounded-2xl border border-border object-cover shadow-sm">
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
                                ? '<img src="'.$img.'" alt="'.$relatedPost->title.'" loading="lazy" decoding="async" class="m-0 h-[76px] w-[100px] flex-shrink-0 rounded-lg object-cover">'
                                : '<div class="m-0 h-[76px] w-[100px] flex-shrink-0 rounded-lg bg-border/20"></div>';
                            $title = htmlspecialchars($relatedPost->title);
                            $relatedList .= '<a href="'.$url.'" class="group/bj flex items-center gap-4 no-underline">'.$imgHtml.'<span class="text-sm font-bold leading-snug text-text-primary transition-colors group-hover/bj:text-accent-secondary">'.$title.'</span></a>';
                        }
                        $bacaJugaHtml = '
                            <div class="not-prose my-10 rounded-2xl border border-border bg-bg-secondary/15 p-6 font-sans">
                                <p class="mb-4 text-[10px] font-black uppercase tracking-[0.25em] text-accent-secondary">Baca Juga</p>
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
                    prose-headings:font-black prose-headings:tracking-tight prose-headings:text-text-primary
                    prose-p:text-text-secondary prose-p:leading-8 prose-p:mb-6
                    prose-strong:text-text-primary
                    prose-a:text-accent-secondary prose-a:no-underline hover:prose-a:underline
                    prose-blockquote:border-l-accent-secondary prose-blockquote:bg-bg-secondary/10 prose-blockquote:py-2 prose-blockquote:px-6 prose-blockquote:rounded-r-xl prose-blockquote:not-italic prose-blockquote:text-text-primary
                    prose-li:text-text-secondary
                    md:prose-lg">
                    {!! $content !!}
                </div>

                {{-- Tags --}}
                @if($post->tags->isNotEmpty())
                    <div class="mt-12 flex flex-wrap gap-2 border-t border-border pt-8">
                        @foreach($post->tags as $tag)
                            <a href="{{ route('blog.tag', $tag->slug) }}"
                               class="rounded-full border border-border bg-bg-primary/50 px-4 py-1.5 text-xs font-medium text-text-secondary no-underline transition-all hover:border-accent-secondary hover:bg-accent-secondary hover:text-accent-primary hover:opacity-100">
                                #{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                @endif

                {{-- Terbaru Lainnya Section (Inside Grid Column) --}}
                @if($latestPosts->isNotEmpty())
                    <div class="mt-20 border-t border-border pt-16">
                        <div class="mb-10 flex items-center justify-between">
                            <div>
                                <h2 class="text-2xl font-black tracking-tight text-text-primary md:text-3xl">Artikel Terbaru <span class="text-accent-secondary">Lainnya</span></h2>
                            </div>
                        </div>

                        <div class="space-y-10">
                            @foreach($latestPosts as $lPost)
                                <article class="group grid gap-6 md:grid-cols-[240px_1fr]">
                                    <a href="{{ route('blog.post.show', [$lPost->category?->slug ?? 'umum', $lPost->slug]) }}" class="relative block aspect-video overflow-hidden rounded-2xl border border-border shadow-sm">
                                        @if($lCover = $lPost->getFirstMediaUrl('post_covers', 'thumb'))
                                            <img src="{{ $lCover }}" alt="{{ $lPost->title }}" loading="lazy" decoding="async" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center bg-border/20 text-[10px] font-bold uppercase tracking-widest text-text-secondary/60">Finlogy</div>
                                        @endif
                                    </a>
                                    <div class="flex flex-col py-1">
                                        <div class="mb-3 flex items-center gap-3">
                                            @if($lPost->category)
                                                <span class="text-[10px] font-black uppercase tracking-widest text-accent-primary">{{ $lPost->category->name }}</span>
                                            @endif
                                            <span class="text-[10px] font-bold uppercase tracking-widest text-text-secondary/70">{{ optional($lPost->published_at)->translatedFormat('d M Y') }}</span>
                                        </div>
                                        <h3 class="mb-3 text-xl font-black leading-tight text-accent-primary">
                                            <a href="{{ route('blog.post.show', [$lPost->category?->slug ?? 'umum', $lPost->slug]) }}" class="no-underline">{{ $lPost->title }}</a>
                                        </h3>
                                        <p class="mb-5 line-clamp-2 text-sm leading-relaxed text-text-secondary/70">
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
                        <h3 class="mb-6 border-b-2 border-accent-secondary pb-2 text-xs font-black uppercase tracking-widest text-text-primary">
                            {{ $post->category?->name ?? 'Berita' }} <span class="text-accent-secondary">Lainnya</span>
                        </h3>
                        <div class="divide-y divide-border">
                            @foreach($relatedPosts as $r)
                                <a href="{{ route('blog.post.show', [$r->category?->slug ?? 'umum', $r->slug]) }}"
                                   class="group flex items-center gap-3 py-4 no-underline first:pt-0">
                                    {{-- Thumb --}}
                                    <div class="relative h-[60px] w-[80px] shrink-0 overflow-hidden rounded-lg bg-border/20">
                                        @if($rCover = $r->getFirstMediaUrl('post_covers', 'thumb'))
                                            <img src="{{ $rCover }}" alt="{{ $r->title }}" loading="lazy" decoding="async" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center bg-border/10 text-[6px] font-bold uppercase tracking-tighter text-text-secondary/60">Finlogy</div>
                                        @endif
                                    </div>
                                    <div class="flex min-w-0 flex-col">
                                        <p class="mb-1.5 line-clamp-2 text-[0.8rem] font-bold leading-tight text-text-primary transition-colors group-hover:text-accent-secondary">
                                            {{ $r->title }}
                                        </p>
                                        <time class="text-[9px] font-bold uppercase tracking-wider text-text-secondary/40">
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
                        <h3 class="mb-6 border-b-2 border-accent-secondary pb-2 text-xs font-black uppercase tracking-widest text-text-primary">
                            Blog <span class="text-accent-secondary">Terpopuler</span>
                        </h3>
                        <div class="space-y-4">
                            @foreach($popularPosts as $i => $pop)
                                <a href="{{ route('blog.post.show', [$pop->category?->slug ?? 'umum', $pop->slug]) }}"
                                   class="group flex items-start gap-3 no-underline">
                                    <span class="mt-0.5 shrink-0 text-xl font-black leading-none text-accent-secondary/20 transition-colors group-hover:text-accent-secondary group-hover:opacity-100">
                                        {{ $i + 1 }}
                                    </span>
                                    {{-- Mini Thumb for Popular --}}
                                    <div class="relative h-[44px] w-[58px] shrink-0 overflow-hidden rounded bg-border/20">
                                        @if($pCover = $pop->getFirstMediaUrl('post_covers', 'thumb'))
                                            <img src="{{ $pCover }}" alt="{{ $pop->title }}" loading="lazy" decoding="async" class="h-full w-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                                        @else
                                            <div class="h-full w-full bg-border/10"></div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="line-clamp-2 text-[0.75rem] font-bold leading-tight text-text-primary transition-colors group-hover:text-accent-secondary">
                                            {{ $pop->title }}
                                        </p>
                                        <div class="mt-1 flex items-center gap-2 text-[8px] font-bold uppercase tracking-widest text-text-secondary/30">
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
