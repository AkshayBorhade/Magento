<?php


namespace First\Module\Model;
use First\Module\Api\Size;

class Small implements Size
{

    public function getSize()
    {
        return "small";
    }
}