<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // ✅ Spatie Role Management
use Filament\Models\Contracts\FilamentUser; // ✅ Filament Access Control
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasRoles; // ✅ Added HasRoles for Spatie Permissions

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ✅ Restrict Admin Panel Access
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('admin'); // 🔒 Only users with 'admin' role can access Filament
    }

    // ✅ Allow Only Authenticated Users to Comment on Blogs
    public function canComment(): bool
    {
        return auth()->check(); // 🔒 Only logged-in users can comment
    }

    // ✅ Allow Only Admins to Manage Blog Posts
    public function canManageBlog(): bool
    {
        return $this->hasRole('admin'); // 🔒 Only Admin can manage blogs
    }
}
