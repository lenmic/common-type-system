<?php

namespace LenMic\CommonTypeSystem\Tree;

use LenMic\CommonTypeSystem\Tree\Visitor\VisitorInterface;

/**
 * @template NodeDataType
 * @template NodeIdType
 */
interface NodeInterface
{
    /**
     * @param NodeDataType $dataObject
     */
    public function setData($dataObject): static;

    /**
     * @return NodeDataType
     */
    public function getData();

    /**
     * @return NodeIdType
     */
    public function getId();

    /**
     * @param NodeIdType $id
     * @return NodeInterface<NodeDataType, NodeIdType>
     */
    public function setId($id): static;

    /**
     * @return NodeIdType
     */
    public function getParentId();

    /**
     * Add a child.
     *
     * @return NodeInterface<NodeDataType, NodeIdType>
     */
    public function addChild(self $child): static;

    /**
     * @return NodeInterface<NodeDataType, NodeIdType>[]
     */
    public function getChildren(): array;

    /**
     * Replace the children set with the given one.
     *
     * @param array<int, NodeInterface> $children
     *
     * @return NodeInterface<NodeDataType, NodeIdType>
     */
    #public function setChildren(array $children): static;

    /**
     * Set the parent node.
     */
    public function setParent(?self $parent = null): void;

    /**
     * @return NodeInterface<NodeDataType, NodeIdType>|null
     */
    public function getParent(): ?NodeInterface;

    /**
     * Return true if the node is the root, false otherwise.
     */
    public function isRoot(): bool;

    public function isChild(): bool;

    public function isLeaf(): bool;

    public function findRoot(): NodeInterface;

    /**
     * @param \LenMic\CommonTypeSystem\Tree\Visitor\VisitorInterface $visitor
     * @return \LenMic\CommonTypeSystem\Tree\NodeSequence<NodeInterface>
     */
    public function accept(VisitorInterface $visitor): NodeSequence;
}