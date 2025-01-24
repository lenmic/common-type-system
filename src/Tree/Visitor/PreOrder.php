<?php

namespace LenMic\CommonTypeSystem\Tree\Visitor;

use LenMic\CommonTypeSystem\Tree\NodeInterface;
use LenMic\CommonTypeSystem\Tree\NodeSequence;

class PreOrder extends AbstractVisitor implements VisitorInterface
{
    /**
     * @return array<int, NodeInterface> $node
     */
    public function visit(NodeInterface $node): NodeSequence
    {
        $nodeSequence = $this->nodeSequence;

        $nodes = [
            $node,
        ];

        $nodeSequence->add($node);

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