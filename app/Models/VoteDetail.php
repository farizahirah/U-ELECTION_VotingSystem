<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VoteDetail extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'vote_details';

    public $fillable = [
        'title',
        'start',
        'end',
    ];

    public function vote()
    {
        return $this->hasMany(Vote::class, 'id', 'vote_id');
    }
}
