<?php

namespace Custom\Appointment\Model\ResourceModel\Appointment;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'app_id';
    public function _construct()
    {
        $this->_init('Custom\Appointment\Model\Appointment', 'Custom\Appointment\Model\ResourceModel\Appointment');
        $this->_map['fields']['app_id'] = 'main_table.app_id';
    }
}