<?php

namespace LenMic\CommonTypeSystem\Collection;

/**
 * @template Key
 * @template Value
 */
interface DictInterface
{
    /**
     * @param Key $key
     * @param Value $value
     */
    public function set($key, $value): self;
}
