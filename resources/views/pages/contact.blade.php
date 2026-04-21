@extends('layouts.app')

@section('content')

    <x-breadcrumbs :links="[
        ['label' => 'Kontak'],
    ]" />

    <article class="mx-auto w-full max-w-7xl">
        <div class="lg:grid lg:grid-cols-[1fr_1.25fr] lg:gap-16 xl:gap-24 lg:items-start pb-20">
            
            {{-- Left column: Typography & Details --}}
            <aside class="mb-16 lg:mb-0 lg:sticky lg:top-32">
                <div class="mb-4 flex items-center gap-3">
                    <span class="h-px w-8 bg-[var(--color-accent-secondary)]"></span>
                    <p class="text-[10px] font-black uppercase tracking-[0.25em] text-[var(--color-accent-secondary)]">Hubungi Saya</p>
                </div>
                
                <h1 class="mb-6 text-4xl font-black leading-[1.1] tracking-tight text-[var(--color-text-primary)] md:text-5xl lg:text-6xl">
                    Contact Me
                </h1>
                
                <div class="mb-12 space-y-6 text-base leading-relaxed text-[var(--color-text-secondary)] opacity-80 xl:text-lg xl:pr-8">
                    <p>
                        Bismillah, Asalamu’alikum Wr. Wb,. Salam Sejahtera untuk kita semua, bahwa dengan adanya kontak ini akan memudahkan kita saling mengenal dan menjalin kerabat serta silaturahmi yang baik.
                    </p>
                    <p>
                        Selain itu, ini juga penting untuk anda bertanya terkait artikel dan administrasi pembelajaran yang mungkin masih membingungkan dan jika demikian anda bisa mengirim pesan serta dapat dengan mudah menghubungi saya lewat email di bawah ini.
                    </p>
                    <p>
                        Kami juga akan membantu masalah-masalah anda guna memperbaiki kualitas daripada website ini.
                    </p>
                    <p class="font-bold text-[var(--color-text-primary)]">
                        Atas nama pengelola blog, kami sangat berterimakasih pada para pengunjung di {{ $settings->site_name ?? 'rppmerdeka' }} ini.
                    </p>
                    <p>
                        Terimakasih,, Wassalam
                    </p>
                </div>
            </aside>

            {{-- Right column: Contact Form Card --}}
            <section class="rounded-3xl border-2 border-[var(--color-bg-secondary)] bg-[var(--color-bg-primary)] p-8 shadow-[0_12px_40px_-20px_rgba(0,0,0,0.1)] transition-colors hover:border-[var(--color-accent-secondary)]/30 sm:p-12 lg:p-16">
                <form action="#" method="POST" class="space-y-8">
                    @csrf
                    
                    <div class="grid gap-8 sm:grid-cols-2">
                        <div class="flex flex-col gap-2">
                            <label for="name" class="text-xs font-black uppercase tracking-widest text-[var(--color-text-primary)]">Nama Lengkap</label>
                            <input type="text" id="name" name="name" required placeholder="Cth: Satoshi Nakamoto"
                                   class="w-full border-b-2 border-[var(--color-bg-secondary)] bg-transparent py-3 text-lg font-semibold text-[var(--color-text-primary)] transition-colors placeholder:font-normal placeholder:opacity-30 focus:border-[var(--color-accent-primary)] focus:outline-none">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="email" class="text-xs font-black uppercase tracking-widest text-[var(--color-text-primary)]">Email Aktif</label>
                            <input type="email" id="email" name="email" required placeholder="cth: hello@domain.com"
                                   class="w-full border-b-2 border-[var(--color-bg-secondary)] bg-transparent py-3 text-lg font-semibold text-[var(--color-text-primary)] transition-colors placeholder:font-normal placeholder:opacity-30 focus:border-[var(--color-accent-primary)] focus:outline-none">
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="subject" class="text-xs font-black uppercase tracking-widest text-[var(--color-text-primary)]">Tujuan / Subjek</label>
                        <select id="subject" name="subject" required
                                class="w-full appearance-none border-b-2 border-[var(--color-bg-secondary)] bg-transparent py-3 text-lg font-semibold text-[var(--color-text-primary)] transition-colors focus:border-[var(--color-accent-primary)] focus:outline-none">
                            <option value="">Pilih keperluan komunikasi...</option>
                            <option value="partnership">Kerja Sama & Afiliasi Bisnis</option>
                            <option value="press">Agensi Rilis Berita (Press Release)</option>
                            <option value="contributor">Pengajuan Kontributor Opini</option>
                            <option value="general">Lainnya / Pelaporan Isu</option>
                        </select>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="message" class="text-xs font-black uppercase tracking-widest text-[var(--color-text-primary)]">Pesan Eksekusi</label>
                        <textarea id="message" name="message" rows="4" required placeholder="Tuliskan pesan atau penawaran Anda selengkap mungkin..."
                                  class="w-full resize-none border-b-2 border-[var(--color-bg-secondary)] bg-transparent py-3 text-lg font-semibold text-[var(--color-text-primary)] transition-colors placeholder:font-normal placeholder:opacity-30 focus:border-[var(--color-accent-primary)] focus:outline-none"></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="button" onclick="alert('Ini adalah desain mockup UI demonstrasi. Logika backend belum dirangkai untuk formulir ini.')"
                                class="group relative inline-flex w-full items-center justify-center overflow-hidden rounded-full bg-[var(--color-accent-primary)] px-8 py-4 font-black uppercase tracking-widest text-[var(--color-bg-primary)] transition-all hover:bg-[#00331c] sm:w-auto">
                            <span class="relative z-10">Kirim Pesan</span>
                        </button>
                    </div>
                </form>
            </section>
            
        </div>
    </article>

@endsection
