<?php

namespace GiftRule\RuleList\Model\ResourceModel;

class Items extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
        
        
           
    protected function _construct()
    {
        $this->_init('custom_gift', 'id');
    }
}
