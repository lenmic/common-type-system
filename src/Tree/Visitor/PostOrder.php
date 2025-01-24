<?php

namespace LenMic\CommonTypeSystem\Tree\Visitor;

use LenMic\CommonTypeSystem\Tree\NodeInterface;
use LenMic\CommonTypeSystem\Tree\NodeSequence;

class PostOrder extends AbstractVisitor implements VisitorInterface
{
    /**
     * @return NodeSequence<NodeInterface>
     */
    public function visit(NodeInterface $node): NodeSequence
    {
        $nodes = [];
        $nodeSequence = $this->nodeSequence;

        foreach ($node->getChildren() as $child) {
            $nodes = \array_merge(
                $nodes,
                $child->accept($this)->toArray(),
            );

            $nodeSequence->merge($child->accept($this));
        }

        $nodes[] = $node;
        $nodeSequence->add($node);

        return $nodeSequence;
    }
}