<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'candidates';

    public $fillable = [
        'user_id',
        'motto',
        'achievement',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vote()
    {
        return $this->hasMany(Vote::class, 'id', 'candidate_id');
    }
}
