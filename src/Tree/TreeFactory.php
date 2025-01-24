<?php

namespace LenMic\CommonTypeSystem\Tree;

use LenMic\CommonTypeSystem\Exception\StrategyNotFoundException;
use LenMic\CommonTypeSystem\Tree\DataProvider\DataProviderInterface;
use LenMic\CommonTypeSystem\Tree\FactoryStrategy\{FactoryStrategyInterface, ArrayStrategy};
use LenMic\CommonTypeSystem\Tree\Node\{NodeHydrator, NodeHydratorInterface};
use LenMic\CommonTypeSystem\AbstractFactory;

class TreeFactory extends AbstractFactory
{
    private static ?TreeFactory $instance = null;

    public static function getInstance(): TreeFactory
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function make(DataProviderInterface $dataProvider): TreeInterface
    {
        $tree = new Tree();
        while ($dataProvider->hasNextNode()) {
            $node = $dataProvider->getNextNode();
            $tree->addNode($node);
        }

        return $tree;
    }

    public static function createFromRootNode(NodeInterface $node): TreeInterface
    {
        $tree = new Tree();
        $tree->setRoot($node);

        return $tree;
    }
}