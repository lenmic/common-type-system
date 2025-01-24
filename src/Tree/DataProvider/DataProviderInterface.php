<?php

namespace LenMic\CommonTypeSystem\Tree\DataProvider;

use LenMic\CommonTypeSystem\Tree\NodeInterface;

interface DataProviderInterface
{
    public function getNextNode(): NodeInterface;

    public function getNodes(): \Generator;

    public function hasNextNode(): bool;
}