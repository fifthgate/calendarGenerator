<?php

namespace Fifthgate\CalendarGenerator\Domain\Collection\Interfaces;

use ArrayAccess;
use Countable;
use Iterator;

interface CollectionInterface  extends Iterator, ArrayAccess, Countable {
    public function add($item);

    public function delete($key) : bool;

    public function isEmpty() : bool;

    public function flush();

    public function sortCollection(callable $sortRoutine) : CollectionInterface;

    public function filter(callable $filterRoutine) : CollectionInterface;

    public function slice(int $length) : array;

    public function hasID(int $id) :bool;

    public function count() : int;
}