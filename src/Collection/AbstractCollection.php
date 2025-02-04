<?php

namespace LenMic\CommonTypeSystem\Collection;

use LenMic\CommonTypeSystem\AbstractCtsObject;
use Illuminate\Support\Collection as BaseCollection;

/**
 * @template T
 * @implements CollectionInterface<T>
 */
abstract class AbstractCollection extends AbstractCtsObject implements CollectionInterface, \IteratorAggregate
{
    /**
     * @var T[]
     */
    protected $items = [];

    protected BaseCollection $collection;

    public function __construct(array $items = [])
    {
        $this->collection = new BaseCollection($items);
    }

    /**
     * @param T $value
     */
    public function add($value): self
    {
        $this->collection->add($value);

        return $this;
    }

    public function count(): int
    {
        return $this->collection->count();
    }

    public function isEmpty(): bool
    {
        return $this->collection->isEmpty();
    }

    public function toArray(): array
    {
        return $this->collection->toArray();
    }

    /**
    * @param CollectionInterface<T> ...$collections
    * @return CollectionInterface<T>
    */
    public function merge(CollectionInterface ...$collections): CollectionInterface
    {
        $this->collection->merge($collections);
    
        return $this;
    }

    public function first()
    {
        return $this->collection->first();
    }

    public function getIterator(): \Traversable
    {
        return $this->collection->getIterator();
    }
}