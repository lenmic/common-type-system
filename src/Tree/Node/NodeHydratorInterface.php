<?php

namespace LenMic\CommonTypeSystem\Tree\Node;

use LenMic\CommonTypeSystem\Tree\NodeInterface;

/**
 * @template T
 */
interface NodeHydratorInterface
{
    /**
     * @param T $data
     * @return \LenMic\CommonTypeSystem\Tree\NodeInterface
     */
    public function hydrate($data): NodeInterface;
}