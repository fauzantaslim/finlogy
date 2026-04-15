<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Settings\GeneralSettings;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Spatie\Tags\Tag;

class BlogController extends Controller
{
    public function index(GeneralSettings $settings): View
    {
        $featuredPost = $this->publishedPostsQuery()
            ->latest('published_at')
            ->first();

        $latestPosts = $this->publishedPostsQuery()
            ->when($featuredPost, fn ($query) => $query->whereKeyNot($featuredPost->id))
            ->latest('published_at')
            ->take(6)
            ->get();

        $popularPosts = $this->publishedPostsQuery()
            ->orderByDesc('views_count')
            ->take(5)
            ->get();

        SEOTools::setTitle($settings->default_meta_title ?: $settings->site_name);
        SEOTools::setDescription($settings->default_meta_description ?: $settings->site_description);

        return view('blog.index', [
            'settings' => $settings,
            'featuredPost' => $featuredPost,
            'latestPosts' => $latestPosts,
            'popularPosts' => $popularPosts,
            'categories' => $this->visibleCategories(),
        ]);
    }

    public function category(string $slug, GeneralSettings $settings): View
    {
        $category = Category::query()
            ->where('slug', $slug)
            ->where('is_visible', true)
            ->firstOrFail();

        $perPage = (int) request()->get('per_page', 5);
        $perPage = in_array($perPage, [5, 10, 15, 20]) ? $perPage : 5;

        $posts = $this->publishedPostsQuery()
            ->whereBelongsTo($category)
            ->latest('published_at')
            ->paginate($perPage)
            ->withQueryString();

        SEOTools::setTitle("Kategori: {$category->name} | {$settings->site_name}");
        SEOTools::setDescription($category->description ?: $settings->site_description);

        return view('blog.category', [
            'settings'    => $settings,
            'category'    => $category,
            'posts'       => $posts,
            'categories'  => $this->visibleCategories(),
            'recentPosts' => $this->publishedPostsQuery()->whereBelongsTo($category)->latest('published_at')->take(5)->get(),
            'popularPosts' => $this->publishedPostsQuery()->whereBelongsTo($category)->orderByDesc('views_count')->take(5)->get(),
        ]);
    }

    public function tag(string $slug, GeneralSettings $settings): View
    {
        $locale = app()->getLocale();

        $tag = Tag::query()
            ->where("slug->{$locale}", $slug)
            ->orWhere('slug->en', $slug)
            ->firstOrFail();

        $perPage = (int) request()->get('per_page', 9);
        $perPage = in_array($perPage, [6, 9, 12, 18]) ? $perPage : 9;

        $posts = $this->publishedPostsQuery()
            ->withAnyTags([$tag])
            ->latest('published_at')
            ->paginate($perPage)
            ->withQueryString();

        $tagName = $tag->name;

        SEOTools::setTitle("Tag: {$tagName} | {$settings->site_name}");
        SEOTools::setDescription("Artikel dengan tag {$tagName} di {$settings->site_name}.");

        return view('blog.tag', [
            'settings' => $settings,
            'tag' => $tag,
            'posts' => $posts,
            'categories' => $this->visibleCategories(),
        ]);
    }

    public function search(GeneralSettings $settings): View
    {
        $query = request()->get('q');

        $posts = $this->publishedPostsQuery()
            ->when($query, function ($q) use ($query) {
                $q->where(function ($sub) use ($query) {
                    $sub->where('title', 'like', "%{$query}%")
                        ->orWhere('content', 'like', "%{$query}%")
                        ->orWhere('excerpt', 'like', "%{$query}%");
                });
            })
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        SEOTools::setTitle("Cari: {$query} | {$settings->site_name}");
        SEOTools::setDescription("Hasil pencarian untuk '{$query}' di {$settings->site_name}.");

        return view('blog.search', [
            'settings'   => $settings,
            'posts'      => $posts,
            'query'      => $query,
            'categories' => $this->visibleCategories(),
        ]);
    }

    private function publishedPostsQuery(): Builder
    {
        return Post::query()
            ->with(['user', 'category', 'tags'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    private function visibleCategories()
    {
        return Category::query()
            ->where('is_visible', true)
            ->orderBy('name')
            ->get();
    }
}
