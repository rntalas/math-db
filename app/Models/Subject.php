<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $validated)
 */
class Subject extends Model
{
    protected $fillable = ['title',
        'locale_id'
    ];
}
