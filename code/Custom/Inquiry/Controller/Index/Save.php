<?php

namespace Custom\Inquiry\Controller\Index;

use Magento\Framework\Controller\ResultFactory;

class Save extends \Magento\Framework\App\Action\Action {

    public function __construct(
    \Magento\Framework\App\Action\Context $context, \Magento\Store\Model\StoreManagerInterface $storeManager, \Custom\Inquiry\Model\InquiryFactory $inquiryFactory) {
        $this->inquiryFactory = $inquiryFactory;
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }

    public function execute() {
        $post = (array) $this->getRequest()->getPost();

        if (!empty($post)) {

            $baseUrl = $this->storeManager->getStore()->getBaseUrl();

            $inquiryFactory = $this->inquiryFactory->create();
            $inquiryFactory->setName($post['name']);
            $inquiryFactory->setEmail($post['email']);
            $inquiryFactory->setPhone($post['phone']);
            $inquiryFactory->setInquiry($post['inquiry']);
            $inquiryFactory->setInquirydate($post['inquirydate']);
            $inquiryFactory->save();

            $this->messageManager->addSuccessMessage('You have submited inquiry '.$post['inquiry']);

            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($baseUrl . 'inquiry');

            return $resultRedirect;
        }
    }

}
