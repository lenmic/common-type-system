<?php

namespace LenMic\CommonTypeSystem\Tree\Node;

use LenMic\CommonTypeSystem\Tree\NodeInterface;
use LenMic\CommonTypeSystem\Tree\Node;

class NodeHydrator implements NodeHydratorInterface
{
    public const ID = 'id';
    public const PARENT_ID = 'parent_id';
    public const VALUE_OBJECT = 'value';
    public const CHILDREN = 'children';

    public function hydrate($data): NodeInterface
    {
        $node = new Node();

        if (isset($data[static::ID])) {
            $node->setId($data[static::ID]);
        }
        if (isset($data[static::PARENT_ID])) {
            $node->setParentId($data[static::PARENT_ID]);
        }
        if (isset($data[static::CHILDREN])) {
            foreach ($data[static::CHILDREN] as $childData) {
                $node->addChild($this->hydrate($childData));
            }
        }

        return $node;
    }
}