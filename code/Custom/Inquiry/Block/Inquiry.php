<?php

namespace Custom\Inquiry\Block;

class Inquiry extends \Magento\Framework\View\Element\Template {

    public function __construct(
    \Magento\Backend\Block\Template\Context $context, array $data = []
    ) {
    
        parent::__construct($context, $data);
    }
    public function getFormUrl() {
        return 'inquiry/index/save';
    }

    public function getListUrl() {
        return 'inquiry/index/inquirylist';
    }
    
}
