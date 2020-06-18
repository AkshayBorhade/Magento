<?php

namespace Custom\Inquiry\Model\ResourceModel;

class Inquiry extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {       
        $this->_init('inquiry', 'inqu_id');
    }
}