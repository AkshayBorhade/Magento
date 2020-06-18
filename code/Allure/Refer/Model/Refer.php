<?php

namespace Allure\Refer\Model;

use Magento\Framework\Model\AbstractModel;

class Refer extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Allure\Refer\Model\ResourceModel\Refer');
    }
}