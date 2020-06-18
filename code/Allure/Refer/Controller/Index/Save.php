<?php
namespace Allure\Refer\Controller\Index;
use Magento\Framework\Controller\ResultFactory;

class Save extends \Magento\Framework\App\Action\Action
{
        public function __construct(
            \Magento\Framework\App\Action\Context $context,
            \Magento\Customer\Model\CustomerFactory $customerFactory,
            \Magento\Store\Model\StoreManagerInterface $storeManager,
            \Allure\Refer\Model\ReferFactory $referFactory,
            \Magento\Customer\Model\Session $customerSession ) {
            $this->_customerFactory = $customerFactory;
            $this->referFactory = $referFactory;
            $this->customerSession = $customerSession;   
            $this->storeManager = $storeManager;
            parent::__construct($context);
        }
    
    public function execute()
    {
        $post = (array) $this->getRequest()->getPost();
        $referCode=$post['code'];
        $baseUrl = $this->storeManager->getStore()->getBaseUrl();
        $flag=1;
        $checkCode=1;
        $customer_id= $this->customerSession->getCustomer()->getId();
        $model = $this->referFactory->create();
        $referCollection =  $model->getCollection();
        $customer = $this->_customerFactory->create()->getCollection()->addAttributeToSelect("*")->load();

        foreach ($customer as $user) {
            $refer = $user->getReferCode();
            $EntityId = $user->getEntityId();
            $Email = $user->getEmail();
            $Name = $user->getFirstname()." ".$user->getLastname();
              if ($refer==$referCode) {
                $checkCode=1;
                break;
              }
              else{
                $checkCode=0;
              }
            }//foreach customer

              if($checkCode==1){  
                  foreach ($referCollection as $collection) {
                    $customerRefered = $collection->getReferedCustomerId();
                    if($customerRefered==$customer_id){
                      $flag=0;
                    }
                    else{
                      $flag=1;
                    }
                  }//foreach collection

                  if($flag==0){
                      $this->messageManager->addErrorMessage('You have already refer Code used.');
                      $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                      $resultRedirect->setUrl($baseUrl . 'refer/index/view');
                      return $resultRedirect;
                    }

                    else{
                        $model->setCustomerId($EntityId);
                        $model->setEmail($Email);
                        $model->setName($Name);
                        $model->setReferralCode($referCode);
                        $model->setStatus(1);
                        $referCustomer = $model->setReferedCustomerId($customer_id);
                        $saveData = $model->save(); 
                        $this->messageManager->addSuccessMessage('You have refer By User '.$Name );
                        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                        $resultRedirect->setUrl($baseUrl . 'refer/index/view');
                        return $resultRedirect;
                    }//else
                  }//if checkCode

                  else{
                    $this->messageManager->addErrorMessage('This is Invalid refer Code.');
                      $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                      $resultRedirect->setUrl($baseUrl . 'refer/index/view');
                      return $resultRedirect;
                  }
    }// excute function
}//class
?>