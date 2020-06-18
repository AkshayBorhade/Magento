<?php

namespace Allure\Affiliate\Model\Withdraw;

class Status implements \Magento\Framework\Option\ArrayInterface
{
	const PENDING = 1;
	const COMPLETE = 2;
	const CANCEL = 3;


	/**
	 * to option array
	 *
	 * @return array
	 */
	public function toOptionArray()
	{
		$options = [];

		foreach ($this->getOptionHash() as $value => $label) {
			$options[] = [
				'value' => $value,
				'label' => $label
			];
		}

		return $options;
	}

	public function getOptionHash()
	{
		return [
			self::PENDING  => __('Pending'),
			self::COMPLETE => __('Complete'),
			self::CANCEL   => __('Cancel')
		];
	}
}
