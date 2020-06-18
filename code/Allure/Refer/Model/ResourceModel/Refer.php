<?php

namespace Allure\Refer\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Refer extends AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('Allure_Refer', 'refer_id');
    }
}
