<?php

namespace Custom\Design\Block\Html;
use Magento\Store\Model\ScopeInterface;

class HeadLinks extends \Magento\Framework\View\Element\Template {

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig) {
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    public function getWelcomeMessage() {
        /*
        $storeEmail = $this->scopeConfig->getValue('custom_config_section/general/welcome_msg', ScopeInterface::SCOPE_STORE);
        
        return $storeEmail;*/
        //return date("h:i:sa");
    }

}
