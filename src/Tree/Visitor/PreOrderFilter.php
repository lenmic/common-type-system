<?php

namespace LenMic\CommonTypeSystem\Tree\Visitor;

use LenMic\CommonTypeSystem\Tree\NodeInterface;
use LenMic\CommonTypeSystem\Tree\NodeSequence;

class PreOrderFilter extends AbstractVisitorFilter
{
    /**
     * @return array<int, NodeInterface> $node
     */
    public function visit(NodeInterface $node): NodeSequence
    {
        $nodeSequence = $this->nodeSequence;

        $callableFilter = $this->callableFilter;
        $filterResult = $callableFilter($node);
        $nodes = [];

        if ($filterResult instanceof NodeInterface) {
            $nodeSequence->add($node);
            $nodes = [$node];
        }

        foreach ($node->getChildren() as $child) {
            $nodes = \array_merge(
                $nodes,
                $child->accept($this)->toArray(),
            );

            $nodeSequence->merge($child->accept($this));
        }

        return $nodeSequence;
    }
}