<?php

namespace Modules\ShortLink\Events;

use Modules\ShortLink\Contracts\CounterRepositoryInterface;

final readonly class IncrementCounter
{
    public function __construct(
        private readonly CounterRepositoryInterface $counterRepository
    )
    {

    }

    public function handle(ShortLinkCreated $event): void
    {
        $this->counterRepository->increment($event->shortLinkData->counter);
    }
}
