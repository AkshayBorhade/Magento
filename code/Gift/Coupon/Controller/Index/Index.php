<?php

namespace Gift\Coupon\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Gift\Coupon\Model\GiftFactory;

class Index extends Action
{
   
    protected $_modelGiftFactory;

   
    public function __construct(
        Context $context,
        GiftFactory $modelGiftFactory
    ) {
        parent::__construct($context);
        $this->_modelGiftFactory = $modelGiftFactory;
    }

    public function execute()
    {
        /**
         * When Magento get your model, it will generate a Factory class
         * for your model at var/generaton folder and we can get your
         * model by this way
         */
        $giftModel = $this->_modelGiftFactory->create();

        // Load the item with ID is 1
        $item = $giftModel->load(1);
        var_dump($item->getData());

        // Get news collection
        $giftCollection = $giftModel->getCollection();
        // Load all data of collection
        var_dump($giftCollection->getData());
    }
}
