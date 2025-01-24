<?php

namespace LenMic\CommonTypeSystem\Tree\Node;

use LenMic\CommonTypeSystem\Tree\Node;

/**
 * @template NodeIdType
 */
interface DataTypeInterface
{
    /**
     * @return NodeIdType
     */
    public function getId();
}