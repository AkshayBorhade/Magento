<?php

/*
 *  Action : set po number to customer order
 */

namespace Custom\Appointment\Controller\Index;

class Custom extends \Magento\Framework\App\Action\Action {

    public function __construct(
    \Magento\Framework\App\Action\Context $context, \Magento\Checkout\Model\Session $checkoutSession, \Magento\Framework\App\RequestInterface $request,\Magento\Framework\Message\ManagerInterface $messageManager) {
        $this->checkoutSession = $checkoutSession;
        $this->request = $request;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    public function execute() {
        $post = $this->request->getPost();
        $quote = $this->checkoutSession->getQuote();
        $quote->setCustomField($post['data']);
        $quote->save();
        $this->messageManager->addSuccess(' saved successfully!');
    }

}

?> 