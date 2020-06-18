<?php

namespace Gift\Coupon\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Gift extends AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('custom_gift', 'id');
    }
}
