<?php

namespace Custom\Grid\Model;

class Grid extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init('Custom\Grid\Model\ResourceModel\Grid');
    }
}
