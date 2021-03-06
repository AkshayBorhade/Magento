<?php

namespace Custom\Appointment\Block;

class Appointment extends \Magento\Framework\View\Element\Template {

    public function __construct(
    \Magento\Backend\Block\Template\Context $context, array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function getFormUrl() {
        return 'index/save';
    }

    public function getListUrl() {
        return 'index/appointmentlist';
    }

}
