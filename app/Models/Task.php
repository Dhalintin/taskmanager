<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'due_date',
        'priority',
        'status',
        'comment'
    ];

    public function statuses()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
