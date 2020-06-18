<?php
namespace First\Module\NotMagento;
class BigPencil implements PencilInterface
{

    public function getPencilType(){
        return "Big Pencil";
    }
}
