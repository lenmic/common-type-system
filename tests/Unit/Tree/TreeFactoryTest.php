<?php

namespace LenMic\CommonTypeSystem\Test\Tree;

use LenMic\CommonTypeSystem\Test\Unit\Tree\NodeData;
use LenMic\CommonTypeSystem\Tree\{Node,TreeFactory,Tree,TreeInterface};
use LenMic\CommonTypeSystem\Tree\Node\NodeHydrator;
use LenMic\CommonTypeSystem\Tree\NodeInterface;
use LenMic\CommonTypeSystem\Tree\DataProvider\ArrayDataProvider;
use Tests\Support\UnitTester;

class TreeFactoryTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
    }

    // tests
    public function testCreatingTreeObjectFromRootNode()
    {
        $nodeDataObject = new NodeData(1, 'Root Node');
        $rootNode = new Node($nodeDataObject);
        $tree = TreeFactory::createFromRootNode($rootNode);
        
        $this->assertInstanceOf(Tree::class, $tree);
        $this->assertInstanceOf(TreeInterface::class, $tree);
        $this->assertInstanceOf(NodeInterface::class, $tree->getRoot());
        $this->assertEquals(1, $tree->count() );
    }

    public function testCreatingTreeFromArray()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Root Node',
            ],
            [
                'id' => 2,
                'name' => 'Child Node 1',
                'parent_id' => 1,
            ],
            [
                'id' => 3,
                'name' => 'Child Node 2',
                'parent_id' => 1,
            ],
            [
                'id' => 4,
                'name' => 'Child Node 3',
                'parent_id' => 2,
            ],
        ];
        
        $arrayDataProvider = new ArrayDataProvider($data, new NodeHydrator());

        $tree = TreeFactory::make($arrayDataProvider);
        
        $this->assertInstanceOf(Tree::class, $tree);
        $this->assertInstanceOf(TreeInterface::class, $tree);

        $root = $tree->getRoot();
        $this->assertInstanceOf(NodeInterface::class, $root);
        $this->assertEquals(4, $tree->count() );
    }
}
