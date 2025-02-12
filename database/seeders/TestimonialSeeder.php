<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        Testimonial::create([
            'name' => 'John Doe',
            'role' => 'Software Engineer',
            'content' => 'Doc Pro has been an invaluable tool for our business. Highly recommended!'
        ]);

        Testimonial::create([
            'name' => 'Jane Smith',
            'role' => 'Freelancer',
            'content' => 'I love how easy it is to use Doc Pro. It’s saved me so much time!'
        ]);
    }
}
