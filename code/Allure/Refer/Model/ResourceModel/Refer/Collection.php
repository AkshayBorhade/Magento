<?php

namespace Allure\Refer\Model\ResourceModel\Refer;

use \Magento\Framework\Model\Resource\Db\Collection\AbstractCollection;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Allure\Refer\Model\Refer',
            'Allure\Refer\Model\ResourceModel\Refer'
        );
    }
    
      protected function _initSelect()
        {   
            parent::_initSelect();
        }
}
