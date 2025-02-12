<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',     // Name of the person providing the testimonial
        'role',     // Role of the person (e.g., job title)
        'content',  // Testimonial content
        'rating',   // Rating provided by the user
    ];
}
