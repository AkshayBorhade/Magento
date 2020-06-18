<?php

namespace Allure\Refer\Block;

class ReferLink extends \Magento\Framework\View\Element\Template {
 
 protected $_urlInterface;
 protected $_registry;
    public function __construct(
    \Magento\Backend\Block\Template\Context $context, array $data = [],
    \Magento\Customer\Model\Session $customerSession, 
    \Magento\Framework\UrlInterface $urlInterface, 
    \Magento\Customer\Model\CustomerFactory $customerFactory,
    \Allure\Refer\Model\ReferFactory $referFactory,
    \Magento\Store\Model\StoreManagerInterface $storeManager
     ) {
        parent::__construct($context, $data);
        $this->customerSession = $customerSession;
        $this->_customerFactory = $customerFactory;
        $this->_urlInterface = $urlInterface;
         $this->referFactory = $referFactory;
        $this->storeManager = $storeManager;
    }

   public function getCustomer(){
        $customer_id= $this->customerSession->getCustomer()->getId();
        return $customer_id;  	
    }

    public function getBase(){
         return $this->_urlInterface->getCurrentUrl();    
    }

    public function getFormUrl() {
        $baseUrl = $this->storeManager->getStore()->getBaseUrl();
        return $baseUrl."refer/index/save";
    }
    public function getMyCode()
    {        
        $customer_id= $this->customerSession->getCustomer()->getId();
        $customer = $this->_customerFactory->create()->load($customer_id);
        $ReferCode = $customer->getReferCode();
        return $ReferCode;
    } 

    public function getLogin() {
        return $this->customerSession->isLoggedIn();
    } 
/*
    public function getRefer() {
    $referFactory = $this->referFactory->create()->getCollection();
    $customer_id= $this->customerSession->getCustomer()->getId();
    $data=0;
        foreach ($referFactory as $refer) {
            if ($refer->getCustomerId() == $customer_id) {
                for ($i=0; $i < 5; $i++) { 
                   $data[$i] = $refer;
                }
            }
           return $data;
        }   
    }*/
}
