<?php

namespace Custom\Design\Block;

class Content extends \Magento\Framework\View\Element\Template {

    public function __construct(\Magento\Framework\View\Element\Template\Context $context,\Magento\Store\Model\StoreManagerInterface $storeManager) {
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }
    
    public function getMediaUrl(){
        $mediaUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl;
    }

}
