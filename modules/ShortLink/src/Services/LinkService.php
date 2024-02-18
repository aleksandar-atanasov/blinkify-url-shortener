<?php

namespace Modules\ShortLink\Services;

use Aleksandar\Multiverse\CustomBaseConverter;
use Modules\ShortLink\Contracts\CounterRepositoryInterface;
use Modules\ShortLink\Contracts\ShortLinkRepositoryInterface;
use Modules\ShortLink\DTOs\ShortLinkData;
use Modules\ShortLink\Enums\BaseNumber;
use Modules\ShortLink\Http\Requests\CreateShortLinkRequest;
use Modules\ShortLink\ValueObjects\CounterData;


final readonly class LinkService
{
    public function __construct(
        private ShortLinkRepositoryInterface $shortLinkRepository,
        private CounterRepositoryInterface $counterRepository,
        private CustomBaseConverter $customBaseConverter,
        private EventDispatcher $eventDispatcher,
    )
    {
    }

    public function createShortLink(CreateShortLinkRequest $request): ShortLinkData
    {
        $counter = $this->counterRepository->get();
        $shortLinkData = $this->shortLinkRepository->save(
            ShortLinkData::fromArray(
                array_merge(
                    $request->validated(),
                    [
                        'counter' => $counter->value(),
                        'short_url' => sprintf(
                            '%s://%s/%s',
                            config('app.env') === 'production' ? 'https' : 'http',
                            $request->input('domain'),
                            $this->customBaseConverter->convert(
                                input: $counter->__toString(),
                                fromBase: BaseNumber::BASE_10->value,
                                toBase: BaseNumber::BASE_62->value
                            ),
                        )
                    ]
                )
            )
        );
        $this->eventDispatcher->dispatchMultiple($shortLinkData->releaseEvents());
        return $shortLinkData;
    }

    public function getOriginalLink(string $shortUrl): ShortLinkData
    {
        return $this->shortLinkRepository->getByCounter(
            CounterData::fromInt(
                $this->customBaseConverter->convert(
                    input: $shortUrl,
                    fromBase: BaseNumber::BASE_62->value,
                    toBase: BaseNumber::BASE_10->value
                )
            )
        );
    }
}
