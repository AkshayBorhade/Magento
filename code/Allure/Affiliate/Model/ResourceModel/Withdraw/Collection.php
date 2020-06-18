<?php

namespace Allure\Affiliate\Model\ResourceModel\Withdraw;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * ID Field Name
     * 
     * @var string
     */
    protected $_idFieldName = 'withdraw_id';

    /**
     * Event prefix
     * 
     * @var string
     */
    protected $_eventPrefix = 'allure_affiliate_withdraw_collection';

    /**
     * Event object
     * 
     * @var string
     */
    protected $_eventObject = 'withdraw_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Allure\Affiliate\Model\Withdraw', 'Allure\Affiliate\Model\ResourceModel\Withdraw');
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
    protected function _toOptionArray($valueField = 'withdraw_id', $labelField = 'increment_id', $additional = [])
    {
        return parent::_toOptionArray($valueField, $labelField, $additional);
    }
}
