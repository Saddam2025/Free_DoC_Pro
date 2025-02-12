<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Models\Category;
use Firefly\FilamentBlog\Models\Tag;
use Illuminate\Support\Facades\Log;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate a dynamic sitemap.xml file for SEO';

    public function handle()
    {
        $sitemap = Sitemap::create();

        // ✅ Add Static Pages
        $staticPages = [
            url('/'),
            url('/about'),
            url('/contact'),
            url('/pricing'),
            url('/features'),
            url('/faq'),
            url('/privacy'),
            url('/terms'),
            url('/blogs'), // ✅ Main Blog Listing Page
        ];

        foreach ($staticPages as $page) {
            $sitemap->add(
                Url::create($page)
                    ->setPriority(1.0)
                    ->setChangeFrequency('weekly')
                    ->setLastModificationDate(now())
            );
        }

        // ✅ Add Document Generator Pages
        $generators = [
            'invoice-generator',
            'credit-note-generator',
            'purchase-order-generator',
            'quote-generator',
            'receipt-generator',
            'proforma-invoice-generator',
            'delivery-note-generator',
            'cv-generator',
            'payment-receipt-generator',
            'expense-report-generator',
            'business-card-generator',
            'job-offer-letter-generator',
            'certificate-generator',
            'agreement-generator'
        ];

        foreach ($generators as $generator) {
            $sitemap->add(
                Url::create(url("/{$generator}"))
                    ->setPriority(0.8)
                    ->setChangeFrequency('weekly')
                    ->setLastModificationDate(now())
            );
        }

        // ✅ Add Individual Blog Posts
        if (class_exists(Post::class)) {
            $posts = Post::where('status', 'published')->latest()->get();
            if ($posts->count()) {
                foreach ($posts as $post) {
                    $sitemap->add(
                        Url::create(url("/blogs/{$post->slug}"))
                            ->setLastModificationDate($post->updated_at ?? now())
                            ->setPriority(0.9)
                            ->setChangeFrequency('daily')
                    );
                }
            } else {
                Log::warning('⚠️ No Blog Posts Found in Database!');
            }
        } else {
            Log::error('⚠️ Skipped Blog Posts: `Post` model does not exist.');
        }

        // ✅ Add Blog Categories (If Model Exists)
        if (class_exists(Category::class)) {
            $categories = Category::all();
            if ($categories->count()) {
                foreach ($categories as $category) {
                    $sitemap->add(
                        Url::create(url("/blogs/categories/{$category->slug}"))
                            ->setLastModificationDate($category->updated_at ?? now())
                            ->setPriority(0.7)
                            ->setChangeFrequency('weekly')
                    );
                }
            } else {
                Log::warning('⚠️ No Blog Categories Found!');
            }
        } else {
            Log::error('⚠️ Skipped Categories: `Category` model does not exist.');
        }

        // ✅ Add Blog Tags (If Model Exists)
        if (class_exists(Tag::class)) {
            $tags = Tag::all();
            if ($tags->count()) {
                foreach ($tags as $tag) {
                    $sitemap->add(
                        Url::create(url("/blogs/tags/{$tag->slug}"))
                            ->setLastModificationDate($tag->updated_at ?? now())
                            ->setPriority(0.6)
                            ->setChangeFrequency('weekly')
                    );
                }
            } else {
                Log::warning('⚠️ No Blog Tags Found in Database!');
            }
        } else {
            Log::error('⚠️ Skipped Tags: `Tag` model does not exist.');
        }

        // ✅ Store the Sitemap
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('✅ Sitemap successfully generated!');
    }
}
