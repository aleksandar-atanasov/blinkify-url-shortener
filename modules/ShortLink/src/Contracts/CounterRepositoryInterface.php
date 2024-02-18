<?php

namespace Modules\ShortLink\Contracts;

use Modules\ShortLink\ValueObjects\CounterData;

interface CounterRepositoryInterface
{
    /**
     * @param CounterData $counter
     * @return CounterData
     */
    public function increment(CounterData $counter): CounterData;

    /**
     * @param CounterData $counter
     * @return CounterData
     */
    public function decrement(CounterData $counter): CounterData;

    /**
     * @param CounterData $counter
     * @return CounterData
     */
    public function reset(CounterData $counter): CounterData;

    /**
     * @return CounterData
     */
    public function get(): CounterData;
}
