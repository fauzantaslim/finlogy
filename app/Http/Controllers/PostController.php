<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Settings\GeneralSettings;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    public function show(string $categorySlug, string $postSlug, GeneralSettings $settings): View
    {
        $category = Category::where('slug', $categorySlug)->where('is_visible', true)->firstOrFail();

        $post = Post::query()
            ->with(['user', 'category', 'tags'])
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

        $description = $post->excerpt ?: str($post->content)->stripTags()->limit(160)->toString();
        SEOTools::setTitle("{$post->title} | {$settings->site_name}");
        SEOTools::setDescription($description);

        SEOTools::opengraph()->setType('article');
        SEOTools::opengraph()->setTitle($post->title);
        SEOTools::opengraph()->setDescription($description);

        SEOTools::jsonLd()->setType('Article');
        SEOTools::jsonLd()->setTitle($post->title);
        SEOTools::jsonLd()->setDescription($description);

        $cover = $post->getFirstMediaUrl('post_covers');
        if (filled($cover)) {
            SEOTools::opengraph()->addImage($cover);
            SEOTools::jsonLd()->addImage($cover);
            SEOTools::twitter()->setImage($cover);
        }

        return view('blog.show', [
            'settings' => $settings,
            'post' => $post->fresh(['user', 'category', 'tags']),
            'relatedPosts' => $relatedPosts,
            'popularPosts' => $popularPosts,
            'latestPosts' => $latestPosts,
            'categories' => Category::query()->where('is_visible', true)->orderBy('name')->get(),
        ]);
    }
}
