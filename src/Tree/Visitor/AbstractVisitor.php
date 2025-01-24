<?php

namespace LenMic\CommonTypeSystem\Tree\Visitor;

use LenMic\CommonTypeSystem\Tree\NodeInterface;
use LenMic\CommonTypeSystem\Tree\NodeSequence;

abstract class AbstractVisitor implements VisitorInterface
{
    /**
     * @var NodeSequence<NodeInterface> 
     */
    protected $nodeSequence;

    /**
     * @param \LenMic\CommonTypeSystem\Tree\NodeSequence<NodeInterface> $nodeSequence
     */
    public function __construct(NodeSequence $nodeSequence)
    {
        $this->nodeSequence = $nodeSequence;
    }
    
    abstract public function visit(NodeInterface $node): NodeSequence;
}