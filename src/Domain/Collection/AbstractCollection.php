<?php

namespace Fifthgate\CalendarGenerator\Domain\Collection;

use Fifthgate\CalendarGenerator\Domain\Collection\Interfaces\CollectionInterface;

class AbstractCollection implements CollectionInterface {

    protected array $collection = [];

    protected int $position;

    public function __construct(array $collection = [])
    {
        $this->collection = $collection;
        $this->position = 0;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->collection[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        $this->position++;
    }

    public function valid(): bool
    {
        return isset($this->collection[$this->position]);
    }

    public function add($item): void
    {
        $this->collection[] = $item;
    }

    public function delete($key) : bool
    {
        if (isset($this->collection[$key])) {
            unset($this->collection[$key]);
            return true;
        }
        return false;
    }

    public function isEmpty() : bool
    {
        return empty($this->collection);
    }

    public function flush(): void
    {
        $this->collection = [];
    }

    public function sortCollection(callable $sortRoutine) : CollectionInterface
    {
        $collection = $this->collection;
        usort($collection, $sortRoutine);
        return new $this($collection);
    }

    public function filter(callable $filterRoutine) : CollectionInterface
    {
        $collection = $this->collection;
        $collection = array_filter($collection, $filterRoutine);
        return new $this($collection);
    }

    public function slice(int $length): array
    {
        return array_chunk($this->collection, $length);
    }

    public function hasID(int $id): bool
    {
        foreach ($this->collection as $item) {
            if ($item->getID() == $id) {
                return true;
            }
        }
        return false;
    }

    public function replace(int $position, $payload): void
    {
        $this->collection[$position] = $payload;
    }

    /**
     * Undocumented function
     *
     * @param integer $n
     * @return void
     */
    public function nth(int $n)
    {
        return isset($this->collection[$n - 1]) ? $this->collection[$n - 1] : null;
    }

    /**
     * Undocumented function
     *
     * @return integer
     */
    public function count() : int
    {
        return count($this->collection);
    }

    public function offsetExists($offset): bool
    {
        return isset($this->collection[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->collection[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        $this->collection[$offset] = $value;
    }

    public function offsetUnset($offset): void
    {
        if ($this->offsetExists($offset)) {
            unset($this->collection[$offset]);
        }
    }

    public function toArray(): array {
        return $this->collection;
    }
}