<?php

namespace Modules\ShortLink\Models;

use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    /**
     * @var string
     */
    protected $table = 'short_links';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'short_url',
        'original_url',
        'user_id',
    ];
}
