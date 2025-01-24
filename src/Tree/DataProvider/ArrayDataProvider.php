<?php

namespace LenMic\CommonTypeSystem\Tree\DataProvider;

use LenMic\CommonTypeSystem\Tree\Node\NodeHydratorInterface;
use LenMic\CommonTypeSystem\Tree\NodeInterface;

class ArrayDataProvider implements DataProviderInterface
{
    private array $nodesData = [];

    /**
     * @var array<NodeInterface>
     */
    private $nodes;

    /**
     * @var int
     */
    private $index = 0;

    private NodeHydratorInterface $nodeHydrator;

    /**
     * @param array $nodesData
     */
    public function __construct(array $nodesData, NodeHydratorInterface $nodeHydrator)
    {
        $this->nodesData = $nodesData;
        $this->nodeHydrator = $nodeHydrator;
    }

    public function getNextNode(): NodeInterface
    {
        return $this->nodeHydrator->hydrate($this->nodesData[$this->index++]);
    }

    public function getNodes(): \Generator
    {
        foreach ($this->nodes as $node) {
            yield $node;
        }
    }

    public function hasNextNode(): bool
    {
        return isset($this->nodesData[$this->index]);
    }
}