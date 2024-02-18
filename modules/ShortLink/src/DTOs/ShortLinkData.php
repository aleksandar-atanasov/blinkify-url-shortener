<?php

namespace Modules\ShortLink\DTOs;

use Modules\ShortLink\Models\ShortLink;
use Modules\ShortLink\ValueObjects\CounterData;

final class ShortLinkData
{
    private array $pendingEvents;

    private function __construct(
        public readonly string $shortUrl,
        public readonly string $originalUrl,
        public readonly ?string $customUrl,
        public readonly string $domain,
        public readonly CounterData $counter,
        public readonly ?int $userId
    )
    {
    }

    public static function fromArray(array $data): ShortLinkData
    {
        return new self(
            shortUrl: data_get($data, 'short_url'),
            originalUrl: data_get($data, 'original_url'),
            customUrl: data_get($data, 'custom_url'),
            domain: data_get($data, 'domain'),
            counter: CounterData::fromInt(data_get($data, 'counter')),
            userId: data_get($data, 'user_id')
        );
    }

    public static function fromEloquentModel(ShortLink $shortLink): ShortLinkData
    {
        return new self(
            shortUrl: $shortLink->getAttribute('short_url'),
            originalUrl: $shortLink->getAttribute('original_url'),
            customUrl: $shortLink->getAttribute('custom_url'),
            domain: $shortLink->getAttribute('domain'),
            counter: CounterData::fromInt($shortLink->getAttribute('counter')),
            userId: $shortLink->getAttribute('user_id')
        );
    }

    public function toArray(): array
    {
        return [
            'short_url' => $this->shortUrl,
            'original_url' => $this->originalUrl,
            'custom_url' => $this->customUrl,
            'domain' => $this->domain,
            'counter' => $this->counter->value(),
            'user_id' => $this->userId
        ];
    }

    public function pushEvent(object $event): void
    {
        $this->pendingEvents[] = $event;
    }

    public function releaseEvents(): array
    {
        $events = $this->pendingEvents;
        $this->pendingEvents = [];
        return $events;
    }
}
