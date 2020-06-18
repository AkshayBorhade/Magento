<?php

namespace Custom\Appointment\Model\ResourceModel;

class Appointment extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {       
        $this->_init('appointment', 'app_id');
    }
}