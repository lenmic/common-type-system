<?php

namespace LenMic\CommonTypeSystem\Tree\Visitor;

use LenMic\CommonTypeSystem\Tree\NodeInterface;
use LenMic\CommonTypeSystem\Tree\NodeSequence;

abstract class AbstractVisitorFilter extends AbstractVisitor
{
    /**
     * @var callable
     */
    protected $callableFilter;

    /**
     * @param \LenMic\CommonTypeSystem\Tree\NodeSequence<NodeInterface> $nodeSequence
     */
    public function __construct(NodeSequence $nodeSequence, callable $callableFilter)
    {
        parent::__construct($nodeSequence);

        $this->callableFilter = $callableFilter;
    }
}