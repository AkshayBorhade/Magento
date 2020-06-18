<?php
/**
* @author Dhirajkumar Deore    
* Copyright © 2018 Magento. All rights reserved.
* See COPYING.txt for license details.
*/
namespace GiftRule\RuleList\Model\ResourceModel;

class Items extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
        
        
           
    protected function _construct()
    {
        $this->_init('custom_gift', 'id');
    }
}
