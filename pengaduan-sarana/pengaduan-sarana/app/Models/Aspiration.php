<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
    protected $fillable = ['user_id', 'category_id', 'title', 'content', 'status'];

    const STATUS_LABELS = [
        'pending'     => 'Menunggu',
        'on_progress' => 'Diproses',
        'resolved'    => 'Selesai',
        'rejected'    => 'Ditolak',
    ];

    const STATUS_COLORS = [
        'pending'     => 'warning',
        'on_progress' => 'info',
        'resolved'    => 'success',
        'rejected'    => 'danger',
    ];

    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_LABELS[$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute(): string
    {
        return self::STATUS_COLORS[$this->status] ?? 'secondary';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class)->latest();
    }

    public function progressUpdates()
    {
        return $this->hasMany(ProgressUpdate::class)->latest();
    }
}
