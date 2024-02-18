<?php

namespace Modules\ShortLink\Repositories;

use Modules\ShortLink\Contracts\CounterRepositoryInterface;
use Modules\ShortLink\Models\Counter;
use Modules\ShortLink\ValueObjects\CounterData;

class CounterRepository implements CounterRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function increment(CounterData $counter): CounterData
    {
        $counterModel = Counter::where('value', $counter->value())->firstOrFail();
        $counterModel->value = $counter->increment()->value();
        $counterModel->save();
        return CounterData::fromEloquentModel($counterModel);
    }

    /**
     * @inheritDoc
     */
    public function decrement(CounterData $counter): CounterData
    {
        $counterModel = Counter::where('value', $counter->value())->firstOrFail();
        $counterModel->value = $counter->decrement()->value();
        $counterModel->save();
        return CounterData::fromEloquentModel($counterModel);
    }

    /**
     * @inheritDoc
     */
    public function reset(CounterData $counter): CounterData
    {
        $counterModel = Counter::where('value', $counter->value())->firstOrFail();
        $counterModel->value = config('app.counter');
        $counterModel->save();
        return CounterData::fromEloquentModel($counterModel);
    }

    /**
     * @inheritDoc
     */
    public function get(): CounterData
    {
        return CounterData::fromEloquentModel(
            Counter::query()->select(['id', 'value'])->firstOrFail()
        );
    }
}
