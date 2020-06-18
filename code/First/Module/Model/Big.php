<?php


namespace First\Module\Model;
use First\Module\Api\Size;

class Big implements Size
{

    public function getSize()
    {
        return "big";
    }
}