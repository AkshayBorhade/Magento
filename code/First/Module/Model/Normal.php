<?php


namespace First\Module\Model;
use First\Module\Api\Size;

class Normal implements Size
{

    public function getSize()
    {
        return "normal";
    }
}