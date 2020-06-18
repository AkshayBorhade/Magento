<?php

namespace Allure\Refer\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;


class SaveReferToCustomer implements ObserverInterface {


    public function __construct(\Magento\Customer\Model\Session $customerSession ) {
         $this->customerSession = $customerSession;
    }

    public function execute(\Magento\Framework\Event\Observer $observer) {

        $customer=$observer->getEmail();
        $observer->setReferCode('abc123');
        $writer = new \Zend\Log\Writer\Stream(BP . "/var/log/refer.log");
           $logger = new \Zend\Log\Logger();
           $logger->addWriter($writer);
           $logger->info("customer: ".$customer);
    }
}
