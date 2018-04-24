<?php
namespace tests;

class IteratorAggregator implements \IteratorAggregate
{

    public $data;

    public function __construct( \Iterator $data )
    {
        $this->data = $data;
    }

    public function getIterator()
    {
        return $this->data;
    }
}
