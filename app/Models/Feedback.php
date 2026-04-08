<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';
    
    protected $fillable = ['aspiration_id', 'admin_id', 'message'];

    public function aspiration()
    {
        return $this->belongsTo(Aspiration::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}