<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;
use SEOTools;

class BlogController extends Controller
{
    /**
     * Display a listing of the blog posts with optional search.
     */
    public function index(Request $request)
    {
        $query = Post::query();

        // Apply search filter
        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
        }

        // Fetch paginated posts
        $posts = $query->where('is_published', true)
                       ->latest()
                       ->paginate(10);

        return view('blog.index', compact('posts'));
    }

    /**
     * Show the form for creating a new blog post.
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created blog post in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        $slug = $this->generateUniqueSlug($request->title);

        $featuredImage = $request->hasFile('featured_image')
            ? $request->file('featured_image')->store('blog_images', 'public')
            : null;

        Post::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'featured_image' => $featuredImage,
            'author' => $request->author ?? 'Admin',
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('blog.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified blog post.
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $relatedPosts = Post::where('id', '!=', $post->id)
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $this->setSeoMetaTags($post);

        return view('blog.show', compact('post', 'relatedPosts'));
    }

    /**
     * Show the form for editing a blog post.
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('blog.edit', compact('post'));
    }

    /**
     * Update the specified blog post in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        $post = Post::findOrFail($id);

        $featuredImage = $post->featured_image;
        if ($request->hasFile('featured_image')) {
            $featuredImage = $request->file('featured_image')->store('blog_images', 'public');
        }

        $post->update([
            'title' => $request->title,
            'slug' => $this->generateUniqueSlug($request->title, $id),
            'content' => $request->content,
            'author' => $request->author ?? $post->author,
            'is_published' => $request->has('is_published'),
            'featured_image' => $featuredImage,
        ]);

        return redirect()->route('blog.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified blog post from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('blog.index')->with('success', 'Post deleted successfully!');
    }

    /**
     * Generate a unique slug for the blog post.
     */
    private function generateUniqueSlug($title, $ignoreId = null)
    {
        $slug = Str::slug($title, '-');
        $count = Post::where('slug', 'LIKE', "{$slug}%")
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    /**
     * Set SEO meta tags for the blog post.
     */
    private function setSeoMetaTags($post)
    {
        SEOTools::setTitle($post->title);
        SEOTools::setDescription(Str::limit(strip_tags($post->content), 150));
        SEOTools::setCanonical(url()->current());
        SEOTools::metatags()->setKeywords(['blog', $post->title, 'Doc Pro']);
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'article');
        SEOTools::twitter()->setSite('@YourTwitterHandle'); // Replace with actual handle
    }
}