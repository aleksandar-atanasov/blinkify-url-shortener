<?php

namespace Modules\ShortLink\Models;

use Illuminate\Database\Eloquent\Model;
use Snowflake\SnowflakeCast;
use Snowflake\Snowflakes;

class Counter extends Model
{
    use Snowflakes;

    /**
     * @var string
     */
    protected $table = 'counter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'value',
    ];

    protected $casts = [
        'id' => SnowflakeCast::class,
    ];
}
