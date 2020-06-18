<?php

namespace Gift\Coupon\Model;

use Magento\Framework\Model\AbstractModel;

class Gift extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Gift\Coupon\Model\ResourceModel\Gift');
    }
}