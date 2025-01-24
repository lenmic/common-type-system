<?php

namespace LenMic\CommonTypeSystem\Tree;

use LenMic\CommonTypeSystem\Query\QueryableInterface;
use LenMic\CommonTypeSystem\Tree\Visitor\PreOrderFilter;

/**
 * 
 */
class Tree implements TreeInterface, QueryableInterface
{
    /**
     * @var NodeInterface[]
     */
    private array $nodes = [];

    /**
     * @var NodeInterface[]
     */
    private array $orphans = [];

    private \SplQueue $queue;

    private NodeInterface $root;

    public function __construct()
    {
        $this->queue = new \SplQueue();
        
    }

    /**
    * Filters nodes based on a callable function.
    *
    * @param callable $func
    * @return NodeSequence<NodeInterface>
     */
    public function where(callable $func)
    {
        $traverseVisitorFilter = new PreOrderFilter(
            new NodeSequence([]),
            $func
        );

        return $this->getRoot()->accept($traverseVisitorFilter);
    }

    /**
     * @param NodeInterface $node
     * @return \LenMic\CommonTypeSystem\Tree\TreeInterface
     */
    public function addNode($node): TreeInterface
    {
        if ($node->isRoot()) {
            $this->setRoot($node);
            return $this;
        } 

        $parent = $this->findNodeById($node->getParentId());
        if ($parent instanceof NodeInterface) {
            $parent->addChild($node);
            return $this;
        }

        $this->queue->enqueue($node);
        return $this;
    }

    public function complete()
    {
        $queueSize = $this->queue->count();
        $orphans = $this->insertOrphans();

        if ($orphans->isEmpty()) { 
            return;
        } 
    }

    protected function insertOrphans()
    {
        $orphans = new \SplQueue();
        while (!$this->queue->isEmpty()) {
            $node = $this->queue->dequeue();
            $parent = $this->findNodeById($node->getParentId());
            if ($parent instanceof NodeInterface) {
                $parent->addChild($node);
                continue;
            }

            $orphans->enqueue($node);
        }

        return $orphans;
    }

    public function findNodeById($id): ?NodeInterface
    {
        $result = $this->where(function (NodeInterface $node) use ($id) {
            if ($node->getId() === $id) {
                return $node;
            }

            return null;
        });

        if ($result->isEmpty()) {
            return null;
        }

        return $result->first();
    }

    private function findNode(NodeInterface $node): ?NodeInterface
    {
        foreach ($this->nodes as $n) {
            if ($n === $node) {
                return $n;
            }
        }

        return null;
    }

    /**
     * @param NodeInterface $root
     * @return \LenMic\CommonTypeSystem\Tree\TreeInterface
     */
    public function setRoot($root): TreeInterface
    {
        $this->root = $root;
        // Implementation of setRoot method
        array_unshift($this->nodes, $root);
        return $this;
    }

    public function getRoot(): NodeInterface
    {
        return $this->root;
    }

    public function count(): int
    {
        return count($this->nodes);
    }

    public function isIncomplete(): bool
    {
        return !$this->queue->isEmpty();
    }
}