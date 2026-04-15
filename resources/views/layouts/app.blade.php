<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! \Artesaos\SEOTools\Facades\SEOTools::generate() !!}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[var(--color-bg-primary)] font-['Poppins'] text-[var(--color-text-primary)] antialiased">
    <div class="flex min-h-screen flex-col">


            {{-- 1. TOP LAYER: Toggle | Logo | Socials --}}
            <div class="hidden md:block w-full bg-[var(--color-bg-primary)] border-b border-[var(--color-border)] py-4">
                <div class="mx-auto flex w-full max-w-7xl items-center justify-between px-6">
                    {{-- Left: Date --}}
                    <div class="text-[10px] font-bold uppercase tracking-widest text-[var(--color-text-primary)]">
                        {{ now()->translatedFormat('l, d F Y') }}
                    </div>

                    {{-- Center: Logo --}}
                    <a href="{{ route('blog.home') }}" class="group flex items-center justify-center no-underline">
                        @if($settings->logo_large_url)
                            <img src="{{ $settings->logo_large_url }}" alt="{{ $settings->site_name }}" class="h-12 md:h-16 w-auto transition-transform hover:scale-[1.02]">
                        @else
                            <span class="text-3xl font-black italic tracking-tighter text-[var(--color-accent-primary)] md:text-4xl transition-transform hover:scale-[1.02]">
                                {{ Str::lower($settings->site_name) }}<span class="text-[var(--color-accent-secondary)]">.id</span>
                            </span>
                        @endif
                    </a>

                    {{-- Right: Social Icons --}}
                    <div class="flex items-center gap-5 text-[var(--color-text-primary)]/70">
                        @if($settings->x_url)
                        <a href="{{ $settings->x_url }}" class="hover:text-[var(--color-accent-primary)]">
                            <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        @endif
                        @if($settings->facebook_url)
                        <a href="{{ $settings->facebook_url }}" class="hover:text-[var(--color-accent-primary)]">
                            <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24"><path d="M14 13.5h2.5l1-4H14v-2c0-1.03.284-2 1.5-2h1.5V1.75c-.273-.037-1.215-.125-2.307-.125C12.42 1.625 10 3.12 10 6.5v3H7v4h3V22h4v-8.5z"/></svg>
                        </a>
                        @endif
                        @if($settings->instagram_url)
                        <a href="{{ $settings->instagram_url }}" class="hover:text-[var(--color-accent-primary)]">
                            <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.981 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- 2. NAV BAR (Sticky) --}}
            <nav class="sticky top-0 z-50 border-b border-[var(--color-border)] bg-[var(--color-bg-primary)]/95 backdrop-blur-xl">
                <div class="mx-auto flex w-full max-w-7xl items-center justify-between px-6 py-4">
                    
                    {{-- --- MOBILE LAYOUT (Hidden on Desktop) --- --}}
                    <div class="flex w-full items-center justify-between md:hidden">
                        {{-- Left: Hamburger --}}
                        <div class="flex flex-1 justify-start">
                            <button id="mobile-menu-toggle" class="text-[var(--color-text-primary)] hover:text-[var(--color-accent-primary)] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                            </button>
                        </div>

                        {{-- Center: Logo --}}
                        <div class="flex flex-none justify-center">
                            <a href="{{ route('blog.home') }}" class="flex items-center">
                                @if($settings->logo_large_url)
                                    <img src="{{ $settings->logo_large_url }}" alt="{{ $settings->site_name }}" class="h-9 w-auto">
                                @else
                                    <span class="text-2xl font-black italic tracking-tighter text-[var(--color-accent-primary)]">
                                        {{ Str::lower($settings->site_name) }}<span class="text-[var(--color-accent-secondary)]">.id</span>
                                    </span>
                                @endif
                            </a>
                        </div>

                        {{-- Right: Search --}}
                        <div class="flex flex-1 justify-end">
                            <button id="search-trigger-mobile" class="text-[var(--color-text-primary)] hover:text-[var(--color-accent-secondary)] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- --- DESKTOP LAYOUT (Hidden on Mobile) --- --}}
                    <div class="hidden w-full items-center justify-between md:flex">
                        {{-- Left: Logo --}}
                        <a href="{{ route('blog.home') }}" class="flex items-center">
                            @if($settings->logo_small_url)
                                <img src="{{ $settings->logo_small_url }}" alt="{{ $settings->site_name }}" class="h-8 w-auto transition-opacity hover:opacity-80">
                            @else
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[var(--color-accent-primary)] text-white font-black italic shadow-lg shadow-[var(--color-accent-primary)]/20">
                                    {{ substr($settings->site_name, 0, 1) }}
                                </div>
                            @endif
                        </a>

                        {{-- Center: Nav Links --}}
                        <div class="flex items-center gap-8">
                            @foreach(($categories ?? collect()) as $navCategory)
                                <a href="{{ route('blog.category', $navCategory->slug) }}"
                                   class="text-xs font-black uppercase tracking-[0.2em] text-[var(--color-text-primary)] hover:text-[var(--color-accent-secondary)] transition-colors @if(request()->is('kategori/' . $navCategory->slug . '*')) text-[var(--color-accent-secondary)] @endif">
                                    {{ $navCategory->name }}
                                </a>
                            @endforeach
                        </div>

                        {{-- Right: Search --}}
                        <div class="flex items-center">
                            <button id="search-trigger-desktop" class="text-[var(--color-text-primary)] hover:text-[var(--color-accent-secondary)] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>
            </nav>


        {{-- SEARCH OVERLAY --}}
        <div id="search-overlay" class="fixed inset-0 z-[60] hidden flex-col items-center justify-start bg-[var(--color-bg-primary)]/98 pt-24 backdrop-blur-xl">
            <button id="close-search" class="absolute right-8 top-8 rounded-full border border-[var(--color-border)] p-3 hover:bg-[var(--color-border)] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="w-full max-w-2xl px-8">
                <p class="mb-6 text-center text-[10px] font-black uppercase tracking-[0.4em] text-[var(--color-accent-secondary)]">Cari Artikel</p>
                <form action="{{ route('blog.search') }}" method="GET">
                    <input type="text" name="q" placeholder="Ketik kata kunci..." 
                           class="w-full border-b-4 border-[var(--color-accent-primary)] bg-transparent py-4 text-2xl font-black text-[var(--color-text-primary)] focus:outline-none md:text-5xl"
                           value="{{ request('q') }}" autofocus>
                </form>
            </div>
        </div>

        {{-- MOBILE MENU SIDEBAR --}}
        <div id="mobile-menu-overlay" class="fixed inset-0 z-[100] hidden">
            {{-- Backdrop --}}
            <div id="mobile-menu-backdrop" class="absolute inset-0 bg-black/60 backdrop-blur-sm opacity-0 transition-opacity duration-300"></div>
            
            {{-- Sidebar Content --}}
            <div id="mobile-menu-sidebar" class="absolute inset-y-0 left-0 flex w-full max-w-[300px] -translate-x-full flex-col bg-[var(--color-bg-primary)] p-8 shadow-2xl transition-transform duration-300 ease-in-out">
                <div class="flex items-center justify-between mb-12">
                    <a href="{{ route('blog.home') }}">
                        @if($settings->logo_small_url)
                            <img src="{{ $settings->logo_small_url }}" alt="{{ $settings->site_name }}" class="h-8 w-auto">
                        @else
                            <span class="text-xl font-black italic text-[var(--color-accent-primary)]">{{ Str::lower($settings->site_name) }}</span>
                        @endif
                    </a>
                    <button id="close-menu" class="rounded-full border border-[var(--color-border)] p-2 hover:bg-[var(--color-border)] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Nav Links --}}
                <div class="flex flex-col gap-6">
                    @foreach(($categories ?? collect()) as $navCategory)
                        <a href="{{ route('blog.category', $navCategory->slug) }}" 
                           class="text-xl font-black uppercase tracking-tight text-[var(--color-text-primary)] hover:text-[var(--color-accent-secondary)] transition-colors">
                            {{ $navCategory->name }}
                        </a>
                    @endforeach
                </div>

                {{-- Bottom Section: Theme & Socials --}}
                <div class="mt-auto pt-10 border-t border-[var(--color-border)]">

                    <div class="flex flex-col gap-4">
                        <span class="text-[10px] font-black uppercase tracking-widest opacity-40">Ikuti Kami</span>
                        <div class="flex items-center gap-6 text-[var(--color-text-primary)]/70">
                            @if($settings->x_url)
                            <a href="{{ $settings->x_url }}" class="hover:text-[var(--color-accent-primary)]">
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </a>
                            @endif
                            @if($settings->facebook_url)
                            <a href="{{ $settings->facebook_url }}" class="hover:text-[var(--color-accent-primary)]">
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M14 13.5h2.5l1-4H14v-2c0-1.03.284-2 1.5-2h1.5V1.75c-.273-.037-1.215-.125-2.307-.125C12.42 1.625 10 3.12 10 6.5v3H7v4h3V22h4v-8.5z"/></svg>
                            </a>
                            @endif
                            @if($settings->instagram_url)
                            <a href="{{ $settings->instagram_url }}" class="hover:text-[var(--color-accent-primary)]">
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.981 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- MAIN CONTENT --}}
        <main class="mx-auto w-full max-w-7xl flex-1 px-6 py-12">
            @yield('content')
        </main>

        {{-- FOOTER --}}
        <footer class="border-t border-[var(--color-border)] bg-gray-50 py-16 dark:bg-gray-900">
            <div class="mx-auto w-full max-w-7xl px-6">
                <div class="grid gap-12 md:grid-cols-2">
                    <div>
                        <a href="{{ route('blog.home') }}" class="inline-block">
                            @if($settings->logo_large_url)
                                <img src="{{ $settings->logo_large_url }}" alt="{{ $settings->site_name }}" class="h-10 w-auto">
                            @else
                                <span class="text-3xl font-black italic text-[var(--color-accent-primary)]">
                                    {{ Str::lower($settings->site_name) }}<span class="text-[var(--color-accent-secondary)]">.id</span>
                                </span>
                            @endif
                        </a>
                        <p class="mt-6 max-w-sm text-sm font-medium leading-relaxed text-[var(--color-text-primary)]/60">
                            {{ $settings->site_description }}
                        </p>
                    </div>
                    <div class="flex flex-col items-end gap-6 text-right md:items-end">
                        <span class="text-[10px] font-black uppercase tracking-widest opacity-40">Terhubung Dengan Kami</span>
                        <div class="flex gap-4">
                            @auth
                                <a href="/admin" class="text-xs font-bold uppercase tracking-widest text-[var(--color-accent-primary)] hover:underline">Admin Panel</a>
                            @else
                                <a href="{{ route('filament.admin.auth.login') }}" class="text-xs font-bold uppercase tracking-widest text-[var(--color-accent-primary)] hover:underline">Masuk</a>
                            @endauth
                        </div>
                        <p class="text-[10px] font-bold uppercase tracking-widest opacity-20">&copy; {{ now()->year }} {{ $settings->site_name }}. Semua hak dilindungi.</p>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    <script>
        const searchOverlay = document.getElementById('search-overlay');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
        const mobileMenuBackdrop = document.getElementById('mobile-menu-backdrop');
        const mobileMenuSidebar = document.getElementById('mobile-menu-sidebar');

        // Search - Support both desktop and mobile triggers
        const openSearch = () => {
            searchOverlay.classList.remove('hidden');
            searchOverlay.querySelector('input').focus();
        };

        document.getElementById('search-trigger-mobile')?.addEventListener('click', openSearch);
        document.getElementById('search-trigger-desktop')?.addEventListener('click', openSearch);
        
        document.getElementById('close-search')?.addEventListener('click', () => {
            searchOverlay.classList.add('hidden');
        });

        // Mobile Menu Sidebar
        const openMobileMenu = () => {
            mobileMenuOverlay.classList.remove('hidden');
            setTimeout(() => {
                mobileMenuBackdrop.classList.replace('opacity-0', 'opacity-100');
                mobileMenuSidebar.classList.replace('-translate-x-full', 'translate-x-0');
            }, 10);
        };

        const closeMobileMenu = () => {
            mobileMenuBackdrop.classList.replace('opacity-100', 'opacity-0');
            mobileMenuSidebar.classList.replace('translate-x-0', '-translate-x-full');
            setTimeout(() => {
                mobileMenuOverlay.classList.add('hidden');
            }, 300);
        };

        document.getElementById('mobile-menu-toggle')?.addEventListener('click', openMobileMenu);
        document.getElementById('close-menu')?.addEventListener('click', closeMobileMenu);
        mobileMenuBackdrop?.addEventListener('click', closeMobileMenu);

        window.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                searchOverlay.classList.add('hidden');
                closeMobileMenu();
            }
        });
    </script>
</body>
</html>
