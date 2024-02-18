<?php

namespace Modules\ShortLink\ValueObjects;

use Modules\ShortLink\Models\Counter;

final readonly class CounterData
{
    private function __construct(private int $value)
    {
    }

    public static function fromInt(int $value): CounterData
    {
        return new self($value);
    }

    public static function fromEloquentModel(Counter $counter): CounterData
    {
        return new self(
            value: (int) $counter->getAttribute('value')
        );
    }

    public function value(): int
    {
        return $this->value;
    }

    public function increment(): CounterData
    {
        return new self($this->value + 1);
    }

    public function decrement(): CounterData
    {
        return new self($this->value - 1);
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
