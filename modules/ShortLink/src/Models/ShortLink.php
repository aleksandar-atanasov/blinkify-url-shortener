<?php

namespace Modules\ShortLink\Models;

use Illuminate\Database\Eloquent\Model;
use Snowflake\SnowflakeCast;
use Snowflake\Snowflakes;

class ShortLink extends Model
{
    use Snowflakes;

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
        'counter',
        'short_url',
        'original_url',
        'custom_url',
        'domain',
        'user_id',
    ];

    protected $casts = [
        'id'      => SnowflakeCast::class,
        'user_id' => SnowflakeCast::class,
    ];
}
