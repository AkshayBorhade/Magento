<?php

namespace Allure\Affiliate\Model\ResourceModel\Group;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	/**
	 * ID Field Name
	 *
	 * @var string
	 */
	protected $_idFieldName = 'group_id';

	/**
	 * Event prefix
	 *
	 * @var string
	 */
	protected $_eventPrefix = 'affiliate_group_collection';

	/**
	 * Event object
	 *
	 * @var string
	 */
	protected $_eventObject = 'group_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Allure\Affiliate\Model\Group', 'Allure\Affiliate\Model\ResourceModel\Group');
	}

	/**
	 * Get SQL for get record count.
	 * Extra GROUP BY strip added.
	 *
	 * @return \Magento\Framework\DB\Select
	 */
	public function getSelectCountSql()
	{
		$countSelect = parent::getSelectCountSql();
		$countSelect->reset(\Zend_Db_Select::GROUP);

		return $countSelect;
	}

	/**
	 * @param string $valueField
	 * @param string $labelField
	 * @param array $additional
	 * @return array
	 */
	protected function _toOptionArray($valueField = 'group_id', $labelField = 'name', $additional = [])
	{
		return parent::_toOptionArray($valueField, $labelField, $additional);
	}
}
