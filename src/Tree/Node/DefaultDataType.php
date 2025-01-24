<?php

namespace LenMic\CommonTypeSystem\Tree\Node;

/**
 * @template NodeIdType
 * @implements DataTypeInterface<NodeIdType>
 */
class DefaultDataType implements DataTypeInterface
{
    /**
     * @var string
     */
    private $id;

    public function __construct(string $id = '')
    {
        $this->id = $id;
        if ($id === '') {
            $this->id = uniqid();
        }
    }

    /**
     * @return string
     */
    public function getId() : string
    {
        return $this->id;
    }
}