<?php


namespace First\Module\Model;
use First\Module\Api\Color;

class Red implements Color
{

    public function getColor()
    {
        return "red";
    }
}