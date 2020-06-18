<?php
namespace Allure\Customer\Block;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\ResourceModel\Group\Collection as CustomerGroup;

Class CustomerGroups extends Template {
    public $_customerGroup;
    public function __construct(
            CustomerGroup $customerGroup
    ) {
        $this->_customerGroup = $customerGroup;
    }
    
    public function getCustomerGroup() {
        $groups = $this->_customerGroup->toOptionArray();
        return $groups;
    }    
}