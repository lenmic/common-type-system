<?php

namespace LenMic\CommonTypeSystem\Collection;

/**
 * @template Key
 * @template Value
 */
class Dict
{
    /**
     * @param array<Key,Value> $entries
     */
    public function __construct(private array $entries) {}

    /**
     * @param Key $key
     * @param Value $value
     */
    public function set($key, $value): self
    {
        $this->entries[$key] = $value;

        return $this;
    }
}
