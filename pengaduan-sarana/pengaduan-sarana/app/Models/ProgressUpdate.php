<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressUpdate extends Model
{
    protected $fillable = ['aspiration_id', 'admin_id', 'description', 'stage'];

    const STAGE_LABELS = [
        'diterima' => 'Diterima',
        'ditinjau' => 'Ditinjau',
        'diproses' => 'Diproses',
        'selesai'  => 'Selesai',
    ];

    public function getStageLabelAttribute(): string
    {
        return self::STAGE_LABELS[$this->stage] ?? $this->stage;
    }

    public function aspiration()
    {
        return $this->belongsTo(Aspiration::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
