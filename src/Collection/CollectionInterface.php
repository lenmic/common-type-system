<?php

declare(strict_types=1);

namespace LenMic\CommonTypeSystem\Collection;

use Countable;

/**
 * @template T
 */
interface CollectionInterface
{
    public function count(): int;
    public function isEmpty(): bool;

    public function toArray(): array;

    #public function add(mixed $element): bool;

    #public function contains(mixed $element, bool $strict = true): bool;

    #public function getType(): string;

    #public function remove(mixed $element): bool;

    #public function column(string $propertyOrMethod): array;

    #public function first(): mixed;

    #public function last(): mixed;

    #public function sort(?string $propertyOrMethod = null, Sort $order = Sort::Ascending): self;

    #public function filter(callable $callback): self;

    /**
     * Create a new collection where the result of the given property, method,
     * or array key of each item in the collection equals the given value.
     *
     * This will always leave the original collection untouched and will return
     * a new one.
     *
     * @param string | null $propertyOrMethod The property, method, or array key
     *     to evaluate. If `null`, the element itself is compared to $value.
     * @param mixed $value The value to match.
     *
     * @return CollectionInterface<T>
     *
     * @throws InvalidPropertyOrMethod if the $propertyOrMethod does not exist
     *     on the elements in this collection.
     * @throws UnsupportedOperationException if unable to call where() on this
     *     collection.
     */
    #public function where(?string $propertyOrMethod, mixed $value): self;

    /**
     * Apply a given callback method on each item of the collection.
     *
     * This will always leave the original collection untouched. The new
     * collection is created by mapping the callback to each item of the
     * original collection.
     *
     * See the {@link http://php.net/manual/en/function.array-map.php PHP array_map() documentation}
     * for examples of how the `$callback` parameter works.
     *
     * @param callable(T): TCallbackReturn $callback A callable to apply to each
     *     item of the collection.
     *
     * @return CollectionInterface<TCallbackReturn>
     *
     * @template TCallbackReturn
     */
    #public function map(callable $callback): self;

    /**
     * Apply a given callback method on each item of the collection
     * to reduce it to a single value.
     *
     * See the {@link http://php.net/manual/en/function.array-reduce.php PHP array_reduce() documentation}
     * for examples of how the `$callback` and `$initial` parameters work.
     *
     * @param callable(TCarry, T): TCarry $callback A callable to apply to each
     *     item of the collection to reduce it to a single value.
     * @param TCarry $initial This is the initial value provided to the callback.
     *
     * @return TCarry
     *
     * @template TCarry
     */
    #public function reduce(callable $callback, mixed $initial): mixed;

    /**
     * Create a new collection with divergent items between current and given
     * collection.
     *
     * @param CollectionInterface<T> $other The collection to check for divergent
     *     items.
     *
     * @return CollectionInterface<T>
     *
     * @throws CollectionMismatchException if the compared collections are of
     *     differing types.
     */
    #public function diff(CollectionInterface $other): self;

    /**
     * Create a new collection with intersecting item between current and given
     * collection.
     *
     * @param CollectionInterface<T> $other The collection to check for
     *     intersecting items.
     *
     * @return CollectionInterface<T>
     *
     * @throws CollectionMismatchException if the compared collections are of
     *     differing types.
     */
    #public function intersect(CollectionInterface $other): self;

    /**
     * Merge current items and items of given collections into a new one.
     *
     * @param CollectionInterface<T> ...$collections The collections to merge.
     *
     * @return CollectionInterface<T>
     *
     * @throws CollectionMismatchException if unable to merge any of the given
     *     collections or items within the given collections due to type
     *     mismatch errors.
     */
    public function merge(CollectionInterface ...$collections): self;
}