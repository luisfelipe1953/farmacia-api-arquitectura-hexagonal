<?php

namespace App\Domain;

abstract class AggregateRoot implements \JsonSerializable
{
    abstract public function toArray(): array;

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}