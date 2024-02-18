<?php

namespace Modules\ShortLink\Contracts;

use Modules\ShortLink\DTOs\ShortLinkData;
use Modules\ShortLink\ValueObjects\CounterData;

interface ShortLinkRepositoryInterface
{

    /**
     * @param CounterData $counter
     * @return ShortLinkData
     */
    public function getByCounter(CounterData $counter): ShortLinkData;

    /**
     * @param ShortLinkData $shortLinkData
     * @return ShortLinkData
     */
    public function save(ShortLinkData $shortLinkData): ShortLinkData;
}
