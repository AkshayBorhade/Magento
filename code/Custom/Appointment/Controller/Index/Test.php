<?php

namespace Custom\Appointment\Controller\Index;

class Test extends \Magento\Framework\App\Action\Action
{

	public function execute()
	{
		$textDisplay = new \Magento\Framework\DataObject(array('text' => 'helloworld'));
		$this->_eventManager->dispatch('Akshay_helloworld_display_text', ['mp_text' => $textDisplay]);
		echo $textDisplay->getText();
		exit;
	}
}