<?php

namespace Custom\Grid\Model\ResourceModel;

class Grid extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {       
        $this->_init('employee', 'employee_id');
    }
}