<?php
namespace Allure\Affiliate\Model\Payment\Methods;

class Offline extends \Allure\Affiliate\Model\Payment\Methods
{
	public function getMethodDetail()
	{
		return [
			'offline_address' => [
				'type'     => 'textarea',
				'label'    => __('Address'),
				'name'     => 'offline_address'
			]
		];
	}

	public function getMethodHtml(){

	}
}