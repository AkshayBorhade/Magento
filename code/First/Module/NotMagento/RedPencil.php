<?php
namespace First\Module\NotMagento;
class RedPencil implements PencilInterface
{
	
	public function getPencilType(){
		return "Red Pencil";
	}
}