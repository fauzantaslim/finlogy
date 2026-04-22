<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Settings\GeneralSettings;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
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

        $categoriesWithPosts = Category::query()
            ->where('is_visible', true)
            ->withCount(['posts' => function ($q) {
                $q->where('status', 'published')
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
            }])
            ->having('posts_count', '>', 0)
            ->orderByDesc('posts_count')
            ->with(['posts' => function ($q) {
                $q->with(['user', 'category'])
                    ->where('status', 'published')
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now())
                    ->orderByDesc('published_at')
                    ->limit(4);
            }])
            ->get();

        $this->configureSeo(
            $settings->default_meta_title ?: 'Home',
            $settings->default_meta_description ?: $settings->site_description,
            null,
            'WebSite'
        );

        return view('blog.index', [
            'settings' => $settings,
            'featuredPost' => $featuredPost,
            'latestPosts' => $latestPosts,
            'popularPosts' => $popularPosts,
            'categoriesWithPosts' => $categoriesWithPosts,
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

        $this->configureSeo(
            "Kategori: {$category->name}",
            $category->description ?: $settings->site_description,
            null,
            'CollectionPage'
        );

        return view('blog.category', [
            'settings' => $settings,
            'category' => $category,
            'posts' => $posts,
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

        $this->configureSeo(
            "Tag: {$tagName}",
            "Artikel dengan tag {$tagName} di {$settings->site_name}.",
            null,
            'CollectionPage'
        );

        return view('blog.tag', [
            'settings' => $settings,
            'tag' => $tag,
            'posts' => $posts,
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

        $this->configureSeo(
            "Cari: {$query}",
            "Hasil pencarian untuk '{$query}' di {$settings->site_name}.",
            null,
            'SearchResultsPage'
        );

        return view('blog.search', [
            'settings' => $settings,
            'posts' => $posts,
            'query' => $query,
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
}
