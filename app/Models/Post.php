<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public const STATUS = [
        'active' => 1,
        'in-active' => 0,
    ];

    protected $fillable = [
        'title',
        'description',
        'slug',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
