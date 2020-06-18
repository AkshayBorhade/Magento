<?php
 
namespace Allure\Affiliate\Model\Campaign;

class Discount implements \Magento\Framework\Option\ArrayInterface
{
	const PERCENT = 'by_percent';
	const FIXED = 'by_fixed';
	const CART_FIXED = 'cart_fixed';
	const BUY_X_GET_Y = 'buy_x_get_y';


	/**
	 * to option array
	 *
	 * @return array
	 */
	public function toOptionArray()
	{
		$options = [
			[
				'value' => self::PERCENT,
				'label' => __('Percent of cart total')
//				'label' => __('Percent of product price discount')
			],
//			[
//				'value' => self::FIXED,
//				'label' => __('Fixed amount discount')
//			],
			[
				'value' => self::CART_FIXED,
				'label' => __('Fixed amount discount for whole cart')
			],
//			[
//				'value' => self::BUY_X_GET_Y,
//				'label' => __('Buy X get Y free (discount amount is Y)')
//			],
		];

		return $options;

	}
}
