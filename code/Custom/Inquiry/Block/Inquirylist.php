<?php

namespace Custom\Inquiry\Block;

class Inquirylist extends \Magento\Framework\View\Element\Template {

    public function __construct(
    \Magento\Backend\Block\Template\Context $context, array $data = [], \Custom\Inquiry\Model\InquiryFactory $inquiryFactory,\Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context, $data);
        $this->inquiryFactory = $inquiryFactory;
        $this->storeManager=$storeManager;
    }

    public function getInquiry() {
        $inquiryFactory = $this->inquiryFactory->create()->getCollection();
        return $inquiryFactory;
    }
    public function getBack(){
        $url=$this->storeManager->getStore()->getBaseUrl();
        /*$resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($url . 'inquiry');*/

        return $url.'inquiry';
    }
}
