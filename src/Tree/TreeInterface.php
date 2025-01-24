<?php

namespace LenMic\CommonTypeSystem\Tree;

interface TreeInterface
{
    /**
     * @param NodeInterface $node
     * @return \LenMic\CommonTypeSystem\Tree\TreeInterface
     */
    public function addNode($node): self;

    /**
     * @param NodeInterface $root
     * @return \LenMic\CommonTypeSystem\Tree\TreeInterface
     */
    public function setRoot($root): self;

    public function getRoot(): NodeInterface;

    public function count(): int;
}