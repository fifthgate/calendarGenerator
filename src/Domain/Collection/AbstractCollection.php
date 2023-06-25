<?php

namespace Fifthgate\CalendarGenerator\Domain\Collection;

use Fifthgate\CalendarGenerator\Domain\Collection\Interfaces\CollectionInterface;

abstract class AbstractCollection implements CollectionInterface {
    protected $collection = [];

    protected $position;

    public function __construct()
    {
        $this->position = 0;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->collection[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        $this->position++;
    }

    public function valid()
    {
        return isset($this->collection[$this->position]);
    }

    public function add($item)
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

    public function flush()
    {
        $this->collection = [];
    }

    public function sortCollection(callable $sortRoutine) : CollectionInterface
    {
        //
    }

    public function filter(callable $filterRoutine) : CollectionInterface
    {
        //
    }

    public function slice(int $length) : array
    {
        return array_chunk($this->collection, $length);
    }

    public function hasID(int $id) :bool
    {
        foreach ($this->collection as $item) {
            if ($item->getID() == $id) {
                return true;
            }
        }
        return false;
    }

    public function replace(int $position, $payload)
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

    public function offsetExists($offset)
    {
        return isset($this->collection[$offset]);
    }

    public function offsetGet($offset): mixed
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
}