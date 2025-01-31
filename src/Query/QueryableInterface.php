<?php

namespace LenMic\CommonTypeSystem\Query;

interface QueryableInterface
{
    public function where(callable $func);
}