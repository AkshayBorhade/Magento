<?php
 
namespace Allure\Affiliate\Model\ResourceModel\Transaction;

/**
 * Class Collection
 * @package Allure\Affiliate\Model\ResourceModel\Transaction
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	/**
	 * ID Field Name
	 *
	 * @var string
	 */
	protected $_idFieldName = 'transaction_id';

	/**
	 * Event prefix
	 *
	 * @var string
	 */
	protected $_eventPrefix = 'affiliate_transaction_collection';

	/**
	 * Event object
	 *
	 * @var string
	 */
	protected $_eventObject = 'transaction_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Allure\Affiliate\Model\Transaction', 'Allure\Affiliate\Model\ResourceModel\Transaction');
	}

	public function getFieldTotal($field = 'amount')
	{
		$this->_renderFilters();

		$sumSelect = clone $this->getSelect();
		$sumSelect->reset(\Zend_Db_Select::ORDER);
		$sumSelect->reset(\Zend_Db_Select::LIMIT_COUNT);
		$sumSelect->reset(\Zend_Db_Select::LIMIT_OFFSET);
		$sumSelect->reset(\Zend_Db_Select::COLUMNS);

		$sumSelect->columns("SUM(`$field`)");

		return $this->getConnection()->fetchOne($sumSelect, $this->_bindParams);
	}
}
