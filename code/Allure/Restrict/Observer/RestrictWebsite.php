<?php
 
namespace Allure\Restrict\Observer;
 
use Magento\Customer\Model\Context;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Store\Model\StoreManagerInterface;
 
class RestrictWebsite implements ObserverInterface
{
 
    /**
     * RestrictWebsite constructor.
     */
    public function __construct(
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Framework\App\Response\Http $response,
        \Magento\Framework\UrlFactory $urlFactory,
        \Magento\Framework\App\Http\Context $context,
        \Magento\Framework\App\ActionFlag $actionFlag
    )
    {
        $this->_response = $response;
        $this->_urlFactory = $urlFactory;
        $this->_context = $context;
        $this->_actionFlag = $actionFlag;
    }
 
    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $storeManager = \Magento\Framework\App\ObjectManager::getInstance()->get('\Magento\Store\Model\StoreManagerInterface');
if ($storeManager->getStore()->getStoreId() == 3){
        $allowedRoutes = [
            'customer_account_login',
            'customer_account_loginpost',
            'customer_account_create',
            'customer_account_createpost',
            'customer_account_logoutsuccess',
            'customer_account_confirm',
            'customer_account_confirmation',
            'customer_account_forgotpassword',
            'customer_account_forgotpasswordpost',
            'customer_account_createpassword',
            'customer_account_resetpasswordpost',
            'customer_section_load'
        ];
 
        $request = $observer->getEvent()->getRequest();
        $isCustomerLoggedIn = $this->_context->getValue(Context::CONTEXT_AUTH);
        $actionFullName = strtolower($request->getFullActionName());
 
        if (!$isCustomerLoggedIn && !in_array($actionFullName, $allowedRoutes)) {
            $this->_response->setRedirect($this->_urlFactory->create()->getUrl('customer/account/login'));
        }
 
    }
}
}