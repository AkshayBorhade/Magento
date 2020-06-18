<?php

/*
 * Action : get logged in customer unit data
 */

namespace Custom\Design\Block\Cart;

class Ponumber extends \Magento\Framework\View\Element\Template {

    protected $customerSession;

    public function __construct(
    \Magento\Framework\View\Element\Template\Context $context) {
        parent::__construct($context);
    }

}

?>