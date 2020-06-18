<?php

namespace Custom\Grid\Model\ResourceModel;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'employee_id';
    public function _construct()
    {
        $this->_init('Custom\Grid\Model\Grid', 'Custom\Grid\Model\ResourceModel\Grid');
        $this->_map['fields']['employee_id'] = 'main_table.employee_id';
    }
}