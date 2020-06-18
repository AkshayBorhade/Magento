<?php
 
namespace Allure\Affiliate\Model\Transaction;

class Type implements \Magento\Framework\Option\ArrayInterface
{
	const COMMISSION = 1;
	const PAID = 2;
	const ADMIN = 3;


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
			self::COMMISSION => __('Commission'),
			self::PAID       => __('Paid'),
			self::ADMIN      => __('Admin')
		];
	}
}
