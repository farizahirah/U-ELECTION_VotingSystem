<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuletinNew extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'buletin_news';

    public $fillable = [
        'title',
        'sub_title',
        'description',
        'document',
        'status',
        'created_by',
    ];
}
