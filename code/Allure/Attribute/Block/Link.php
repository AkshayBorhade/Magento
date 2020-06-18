<?php

namespace Allure\Attribute\Block;

class Link extends \Magento\Framework\View\Element\Html\Link{

    protected $_template = 'Allure_Attribute::customlink.phtml';

    public function getHref()
    {
        return $this->getUrl('customer/account/login/');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getLabel()
    {
        return __('Demo Link');
    }
   
}
?>