<?php

namespace Allure\Customer\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Message\ManagerInterface;

Class SaveCustomerGroupId implements ObserverInterface {
    public $_customerRepositoryInterface;
    public $_messageManager;
    public function __construct(
            CustomerRepositoryInterface $customerRepositoryInterface,
            ManagerInterface $messageManager
    ) {
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
        $this->_messageManager = $messageManager;
    }
    
    public function execute(\Magento\Framework\Event\Observer $observer) {
       $accountController = $observer->getAccountController();
       $request = $accountController->getRequest();
       $group_id = $request->getParam('group_id');
       
       try {
           $customerId = $observer->getCustomer()->getId();
           $customer = $this->_customerRepositoryInterface->getById($customerId);
           $customer->setGroupId($group_id);
           $this->_customerRepositoryInterface->save($customer);
           
       } catch (Exception $e){
           $this->_messageManager->addErrorMessage(__('Something went wrong! Please try again.'));
       }
    }
}