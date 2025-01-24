<?php

namespace LenMic\CommonTypeSystem\Tree\Visitor;

use LenMic\CommonTypeSystem\Tree\NodeInterface;
use LenMic\CommonTypeSystem\Tree\NodeSequence;

interface VisitorInterface
{
    public function visit(NodeInterface $node): NodeSequence;
}