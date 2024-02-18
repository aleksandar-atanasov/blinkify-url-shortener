<?php

namespace Modules\ShortLink\Events;

use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\ShortLink\DTOs\ShortLinkData;

class ShortLinkCreated implements ShouldDispatchAfterCommit
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public ShortLinkData $shortLinkData)
    {

    }
}
