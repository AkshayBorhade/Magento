<?php


namespace First\Module\Model;


use First\Module\Api\PencilInterface;
use First\Module\Api\Color;
use First\Module\Api\Size;

class Pencil implements PencilInterface
{
protected $color;
protected $size;
    public function __construct(Color $color,Size $size)
    {
        $this->color=$color;
        $this->size=$size;
    }

    public function getPencilType()
    {
        return "Pencil has ".$this->color->getColor()." color and ".$this->size->getSize()." size";
    }
}