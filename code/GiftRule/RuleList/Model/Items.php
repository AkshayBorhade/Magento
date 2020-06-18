<?php
/**
* @author Dhirajkumar Deore    
* Copyright © 2018 Magento. All rights reserved.
* See COPYING.txt for license details.
*/
namespace GiftRule\RuleList\Model;

class Items extends \Magento\Framework\Model\AbstractModel
{
        
        
    protected function _construct()
    {
        $this->_init('GiftRule\RuleList\Model\ResourceModel\Items');
    }
        
        
    public function getAvailableStatuses()
    {
                
                
        $availableOptions = ['1' => 'Enable',
                          '0' => 'Disable'];
                
        return $availableOptions;
    }
}
