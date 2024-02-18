<?php

namespace Modules\ShortLink\Services;

use Illuminate\Contracts\Events\Dispatcher;

final readonly class EventDispatcher implements Dispatcher
{
    public function __construct(private Dispatcher $dispatcher)
    {
    }

    public function listen($events, $listener = null)
    {
        return $this->dispatcher->listen($events, $listener);
    }

    public function hasListeners($eventName): bool
    {
        return $this->dispatcher->hasListeners($eventName);
    }

    public function subscribe($subscriber): void
    {
        $this->dispatcher->subscribe($subscriber);
    }

    public function until($event, $payload = [])
    {
        return $this->dispatcher->until($event, $payload);
    }

    public function dispatch($event, $payload = [], $halt = false): ?array
    {
        return $this->dispatcher->dispatch($event, $payload, $halt);
    }

    public function push($event, $payload = [])
    {
        return $this->dispatcher->push($event, $payload);
    }

    public function flush($event): void
    {
        $this->dispatcher->flush($event);
    }

    public function forget($event): void
    {
        $this->dispatcher->forget($event);
    }

    public function forgetPushed(): void
    {
        $this->dispatcher->forgetPushed();
    }

    public function dispatchMultiple(array $events): void
    {
        foreach ($events as $event) {
            $this->dispatch($event);
        }
    }
}
