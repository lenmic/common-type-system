<?php

namespace LenMic\CommonTypeSystem\Test\Unit\Tree;

class NodeData
{
    public function __construct(private int $id, private string $value)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}