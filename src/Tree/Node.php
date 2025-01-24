<?php

namespace LenMic\CommonTypeSystem\Tree;

use LenMic\CommonTypeSystem\Tree\Visitor\VisitorInterface;
use LenMic\CommonTypeSystem\Tree\Node\DataTypeInterface;

/**
 * @template NodeDataType of DataTypeInterface
 * @template NodeIdType
 * @implements NodeInterface<NodeDataType,NodeIdType>
 */
class Node implements NodeInterface
{
    /**
     * @var NodeIdType $id
     */
    private $id;

    /**
     * @var NodeIdType $parentId 
     */
    private $parentId;

    /**
     * @var NodeInterface<NodeDataType, NodeIdType> $parent
     */
    private ?NodeInterface $parent = null;

    /**
     * @var NodeInterface<NodeDataType, NodeIdType>[] $children
     */
    private array $children = [];

    /**
     * @var NodeDataType $dataObject
     */
    private $dataObject;

    /**
     * @var class-string<NodeDataType> $className
     */
    private $className;

    /**
     * @return NodeIdType
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return NodeIdType
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param NodeIdType $id
     * @return NodeInterface<NodeDataType, NodeIdType>
     */
    public function setId($id): static
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param NodeIdType $id
     * @return NodeInterface<NodeDataType, NodeIdType>
     */
    public function setParentId($parentId): static
    {
        $this->parentId = $parentId;
        return $this;
    }

    /**
     * @param NodeDataType|null $dataObject
     */
    public function __construct($dataObject = null) 
    {
        if ($dataObject !== null) {
            $this->setData($dataObject);
        }

        if ($this->id === null) {
            $this->id = uniqid();
        }
    }

    public function findRoot(): NodeInterface
    {
        $current = $this;
        while ($current->getParent() !== null) {
            $current = $current->getParent();
        }
        return $current;
    }

    /**
     * @param \LenMic\CommonTypeSystem\Tree\Visitor\VisitorInterface $visitor
     * @return \LenMic\CommonTypeSystem\Tree\NodeSequence<NodeInterface>
     */
    public function accept(VisitorInterface $visitor): NodeSequence
    {
        return $visitor->visit($this);
    }

    /**
     * @param \LenMic\CommonTypeSystem\Tree\NodeInterface $child
     * @return NodeInterface<NodeDataType, NodeIdType>
     */
    public function addChild(NodeInterface $child): static
    {
        $child->setParent($this);
        $this->children[] = $child;

        return $this;
    }

    public function getAncestors(): array
    {
        $ancestors = [];
        $current = $this->parent;
        while ($current !== null) {
            $ancestors[] = $current;
            $current = $current->getParent();
        }

        return $ancestors;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @return NodeDataType
     */
    public function getData()
    {
        return $this->dataObject;
    }

    /**
     * @return NodeInterface<NodeDataType, NodeIdType>|null
     */
    public function getParent(): ?NodeInterface
    {
        return $this->parent;
    }

    public function getSize(): int
    {
        $size = 1;
        foreach ($this->children as $child) {
            $size += $child->getSize();
        }
        return $size;
    }

    public function isChild(): bool
    {
        return $this->parent !== null;
    }

    public function isLeaf(): bool
    {
        return empty($this->children);
    }

    public function isRoot(): bool
    {
        return ($this->parent === null) && ($this->parentId === null);
    }

    public function removeAllChildren(): static
    {
        $this->children = [];
        return $this;
    }

    public function root(): static
    {
        $current = $this;
        while ($current->getParent() !== null) {
            $current = $current->getParent();
        }
        return $current;
    }

    public function setChildren(array $children): static
    {
        $this->children = $children;
        foreach ($children as $child) {
            $child->setParent($this);
        }
        return $this;
    }

    /**
     * @param NodeDataType $dataObject
     */
    public function setData($dataObject): static
    {
        $this->dataObject = $dataObject;
        $this->className = get_class($dataObject);
        $this->id = $dataObject->getId();

        return $this;
    }

    public function setParent(?NodeInterface $parent = null): void
    {
        $this->parent = $parent;
    }
}