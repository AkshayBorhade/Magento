<?php

namespace Custom\Inquiry\Model\ResourceModel\Inquiry;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'inqu_id';
    public function _construct()
    {
        $this->_init('Custom\Inquiry\Model\Inquiry', 'Custom\Inquiry\Model\ResourceModel\Inquiry');
        $this->_map['fields']['inqu_id'] = 'main_table.inqu_id';
    }
}