<?php
namespace First\Module\NotMagento;
class YellowPencil implements PencilInterface
{
	
	public function getPencilType(){
		return "Yellow Pencil";
	}
}