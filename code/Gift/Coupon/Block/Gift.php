<?php

namespace Gift\Coupon\Block;
use Gift\Coupon\Model\GiftFactory;

class Gift extends \Magento\Framework\View\Element\Template {

    public function __construct(
    \Magento\Backend\Block\Template\Context $context, array $data = [],
    \Magento\Customer\Model\Session $customerSession,
    GiftFactory $modelGiftFactory
     ) {
        parent::__construct($context, $data);
        $this->customerSession = $customerSession;
        $this->_modelGiftFactory = $modelGiftFactory;
    }

    public function getCard(){
        $customer_id= $this->customerSession->getCustomer()->getId();

        $giftFactory = $this->_modelGiftFactory->create();
        $giftCollection = $giftFactory->getCollection();
        
        foreach ($giftCollection as $gift) {
            $gcCustomer = $gift->getCustomerId();
            if ($gcCustomer == $customer_id) {
                    $GiftCard = $gift->getCode();
            }
        }
        return $GiftCard;  	
    }
}
