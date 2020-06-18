<?php

namespace Custom\Appointment\Model;

class Appointment extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init('Custom\Appointment\Model\ResourceModel\Appointment');
    }
}
