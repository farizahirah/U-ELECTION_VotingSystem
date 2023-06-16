<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Feedback extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'feedback';

    public $fillable = [
        'user_id',
        'feedback_header',
        'feedback_body',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
