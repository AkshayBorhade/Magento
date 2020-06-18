<?php

namespace Custom\Inquiry\Model;

class Inquiry extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init('Custom\Inquiry\Model\ResourceModel\Inquiry');
    }
}
