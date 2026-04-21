<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Settings\GeneralSettings;

class PageController extends Controller
{
    public function about(GeneralSettings $settings)
    {
        $this->configureSeo('Tentang Kami', 'Pelajari lebih lanjut tentang visi, misi, dan tim di balik karya editorial kami.', null, 'AboutPage');

        return view('pages.about', [
            'settings' => $settings,
            'categories' => Category::query()->where('is_visible', true)->orderBy('name')->get(),
        ]);
    }

    public function contact(GeneralSettings $settings)
    {
        $this->configureSeo('Kontak', 'Hubungi tim redaksi kami untuk pertanyaan, kerja sama, dan informasi lebih lanjut.', null, 'ContactPage');

        return view('pages.contact', [
            'settings' => $settings,
            'categories' => Category::query()->where('is_visible', true)->orderBy('name')->get(),
        ]);
    }

    public function privacy(GeneralSettings $settings)
    {
        $this->configureSeo('Kebijakan Privasi', 'Kebijakan mengenai cara kami mengatur dan memproses data Anda untuk keamanan privasi penuh.', null, 'WebPage');

        return view('pages.privacy', [
            'settings' => $settings,
            'categories' => Category::query()->where('is_visible', true)->orderBy('name')->get(),
        ]);
    }

    public function disclaimer(GeneralSettings $settings)
    {
        $this->configureSeo('Penafian (Disclaimer)', 'Pernyataan pelepasan tanggung jawab atas batasan informasi dalam platform editorial kami.', null, 'WebPage');

        return view('pages.disclaimer', [
            'settings' => $settings,
            'categories' => Category::query()->where('is_visible', true)->orderBy('name')->get(),
        ]);
    }

    public function tos(GeneralSettings $settings)
    {
        $this->configureSeo('Syarat & Ketentuan', 'Syarat dan ketentuan layanan (TOS) penggunaan website kami.', null, 'WebPage');

        return view('pages.tos', [
            'settings' => $settings,
            'categories' => Category::query()->where('is_visible', true)->orderBy('name')->get(),
        ]);
    }
}
