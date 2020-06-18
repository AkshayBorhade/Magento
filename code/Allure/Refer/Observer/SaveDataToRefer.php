<?php

namespace Allure\Refer\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;


class SaveDataToRefer implements ObserverInterface {
protected $_registry;
protected $_urlInterface;

    public function __construct( \Magento\Framework\UrlInterface $urlInterface, 
        \Magento\Framework\Registry $registry ) {
        $this->_registry = $registry;
        $this->_urlInterface = $urlInterface;
    }

    public function execute(\Magento\Framework\Event\Observer $observer) {
        $currentProduct=$this->_registry->registry('current_product');
        $sku = $currentProduct->getSku();
        $url = $this->_urlInterface->getCurrentUrl();
        //$customer=$_GET['customer_id'];
        //$product=$_GET['product_id'];
        $writer = new \Zend\Log\Writer\Stream(BP . "/var/log/refer.log");
           $logger = new \Zend\Log\Logger();
           $logger->addWriter($writer);
           $logger->info("sku: ".$sku." url: ".$url);
    }
}
