<?php

namespace Modules\ShortLink\Providers;

use \App\Providers\EventServiceProvider as BaseEventServiceProvider;
use Modules\ShortLink\Events\IncrementCounter;
use Modules\ShortLink\Events\ShortLinkCreated;

class EventServiceProvider extends BaseEventServiceProvider
{
    protected $listen = [
      ShortLinkCreated::class => [
        IncrementCounter::class,
      ],
    ];
}
