<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['password' => 'hashed'];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isSiswa(): bool
    {
        return $this->role === 'siswa';
    }

    public function aspirations()
    {
        return $this->hasMany(Aspiration::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'admin_id');
    }

    public function progressUpdates()
    {
        return $this->hasMany(ProgressUpdate::class, 'admin_id');
    }
}
