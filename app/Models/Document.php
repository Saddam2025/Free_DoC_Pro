<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    // If your table name is different from the default Laravel plural form, specify it here
    protected $table = 'documents'; // Table name (if needed)

    // Define which attributes are mass assignable
    protected $fillable = ['name', 'description']; // Add the necessary columns for your table
}
