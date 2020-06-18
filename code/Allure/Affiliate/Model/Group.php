<?php

namespace Allure\Affiliate\Model;

/**
 * Class Group
 * @package Allure\Affiliate\Model
 */
class Group extends \Magento\Framework\Model\AbstractModel
{
	/**
	 * Cache tag
	 *
	 * @var string
	 */
	const CACHE_TAG = 'affiliate_group';

	/**
	 * Cache tag
	 *
	 * @var string
	 */
	protected $_cacheTag = 'affiliate_group';

	/**
	 * Event prefix
	 *
	 * @var string
	 */
	protected $_eventPrefix = 'affiliate_group';


	/**
	 * Initialize resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Allure\Affiliate\Model\ResourceModel\Group');
	}

	/**
	 * Get identities
	 *
	 * @return array
	 */
	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}
}
