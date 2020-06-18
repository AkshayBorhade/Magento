<?php

namespace Gift\Coupon\Model\ResourceModel\Gift;

use \Magento\Framework\Model\Resource\Db\Collection\AbstractCollection;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Gift\Coupon\Model\Gift',
            'Gift\Coupon\Model\ResourceModel\Gift'
        );
    }
    
      protected function _initSelect()
        {   
          
            parent::_initSelect();
        }
}
