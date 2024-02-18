<?php

namespace Modules\ShortLink\Repositories;

use Modules\ShortLink\Contracts\ShortLinkRepositoryInterface;
use Modules\ShortLink\DTOs\ShortLinkData;
use Modules\ShortLink\Events\ShortLinkCreated;
use Modules\ShortLink\Exceptions\ShortLinkNotFound;
use Modules\ShortLink\Models\ShortLink;
use Modules\ShortLink\ValueObjects\CounterData;

class ShortLinkRepository implements ShortLinkRepositoryInterface
{

    /**
     * @param CounterData $counter
     * @return ShortLinkData
     * @throws ShortLinkNotFound
     */
    public function getByCounter(CounterData $counter): ShortLinkData
    {
        $shortLink = ShortLink::where('counter', $counter->value())->first();
        if (!$shortLink) {
            throw new ShortLinkNotFound('Short link not found');
        }
        return ShortLinkData::fromEloquentModel($shortLink);
    }

    /**
     * @param ShortLinkData $shortLinkData
     * @return ShortLinkData
     */
    public function save(ShortLinkData $shortLinkData): ShortLinkData
    {
        $shortLinkData = ShortLinkData::fromEloquentModel(
            ShortLink::create($shortLinkData->toArray())
        );
        $shortLinkData->pushEvent(new ShortLinkCreated($shortLinkData));
        return $shortLinkData;
    }
}
