<?php
 
namespace Allure\Affiliate\Model\Transaction;

class Status implements \Magento\Framework\Option\ArrayInterface
{
	const STATUS_HOLD = 2;
	const STATUS_COMPLETED = 3;
	const STATUS_CANCELED = 4;

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
			self::STATUS_HOLD      => __('On Hold'),
			self::STATUS_COMPLETED => __('Completed'),
			self::STATUS_CANCELED  => __('Cancelled')
		];
	}
}
