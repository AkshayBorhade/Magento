<?php


namespace First\Module\Model;
use First\Module\Api\Color;

class Yellow implements Color
{

    public function getColor()
    {
        return "yellow";
    }
}