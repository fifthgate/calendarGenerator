<?php

namespace Fifthgate\CalendarGenerator\Domain;

use Fifthgate\CalendarGenerator\Domain\Interfaces\CalendarRenderableEventInterface;
use \DateTimeInterface;

class GenericCalendarEvent implements CalendarRenderableEventInterface
{
    protected string $title;

    protected string $body;

    protected DateTimeInterface $startDate;

    protected DateTimeInterface $endDate;

    public function __construct(
        string $title,
        string $body,
        DateTimeInterface $startDate,
        DateTimeInterface $endDate
    ) {
        $this->title = $title;
        $this->body = $body;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function getStartDate() : DateTimeInterface
    {
        return $this->startDate;
    }

    public function getEndDate() : DateTimeInterface
    {
        return $this->endDate;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getBody() : string
    {
        return $this->body;
    }

    public function getPreview() : string
    {
        return strip_tags(substr($this->body, 0, 200)).'...';
    }
}
