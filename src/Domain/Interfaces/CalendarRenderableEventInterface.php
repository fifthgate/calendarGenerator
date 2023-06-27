<?php

namespace Fifthgate\CalendarGenerator\Domain\Interfaces;

use \DateTimeInterface;

interface CalendarRenderableEventInterface
{
    public function getTitle() : string;

    public function getBody() : string;

    public function getStartDate() : DateTimeInterface;

    public function getEndDate() : DateTimeInterface;
}
