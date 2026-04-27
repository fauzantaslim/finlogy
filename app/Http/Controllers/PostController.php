<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Settings\GeneralSettings;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    public function show(string $categorySlug, string $postSlug, GeneralSettings $settings): View
    {
        $category = Category::where('slug', $categorySlug)->where('is_visible', true)->firstOrFail();

        $post = Post::query()
            ->with(['user', 'category', 'tags', 'faqs'])
            ->whereBelongsTo($category)
            ->where('slug', $postSlug)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->firstOrFail();

        $post->increment('views_count');

        $relatedPosts = Post::query()
            ->with(['category'])
            ->where('status', 'published')
            ->whereBelongsTo($post->category)
            ->whereKeyNot($post->id)
            ->latest('published_at')
            ->take(5)
            ->get();

        $popularPosts = Post::query()
            ->with(['category'])
            ->where('status', 'published')
            ->orderByDesc('views_count')
            ->take(5)
            ->get();

        $latestPosts = Post::query()
            ->with(['category', 'user'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->whereKeyNot($post->id)
            ->latest('published_at')
            ->take(6)
            ->get();

        $description = $post->meta_description ?: ($post->excerpt ?: str($post->content)->stripTags()->limit(160)->toString());

        $this->configureSeo(
            $post->title,
            $description,
            $post->getFirstMediaUrl('post_covers', 'optimized'),
            'Article'
        );

        // Add additional Article JSON-LD properties
        \Artesaos\SEOTools\Facades\SEOTools::jsonLd()->addValue('headline', $post->title);
        \Artesaos\SEOTools\Facades\SEOTools::jsonLd()->addValue('author', [
            '@type' => 'Person',
            'name' => $post->user?->name ?? config('app.name'),
        ]);
        \Artesaos\SEOTools\Facades\SEOTools::jsonLd()->addValue('publisher', [
            '@type' => 'Organization',
            'name' => $settings->site_name ?: config('app.name'),
            'logo' => [
                '@type' => 'ImageObject',
                'url' => $settings->logo_large_url ?? url('favicon.ico'),
            ],
        ]);
        \Artesaos\SEOTools\Facades\SEOTools::jsonLd()->addValue('datePublished', $post->published_at?->toIso8601String());
        \Artesaos\SEOTools\Facades\SEOTools::jsonLd()->addValue('dateModified', $post->updated_at?->toIso8601String());

        if ($post->faqs->isNotEmpty()) {
            $faqs = [];
            foreach ($post->faqs as $faq) {
                $faqs[] = [
                    '@type' => 'Question',
                    'name' => $faq->question,
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $faq->answer,
                    ],
                ];
            }
            \Artesaos\SEOTools\Facades\SEOTools::jsonLd()->addValue('mainEntity', $faqs);
            \Artesaos\SEOTools\Facades\SEOTools::jsonLd()->setType('FAQPage');
        }

        return view('blog.show', [
            'settings' => $settings,
            'post' => $post->fresh(['user', 'category', 'tags']),
            'relatedPosts' => $relatedPosts,
            'popularPosts' => $popularPosts,
            'latestPosts' => $latestPosts,
        ]);
    }
}
