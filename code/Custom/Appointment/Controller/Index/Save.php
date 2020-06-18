<?php

namespace Custom\Appointment\Controller\Index;

use Magento\Framework\Controller\ResultFactory;

class Save extends \Magento\Framework\App\Action\Action {

    public function __construct(
    \Magento\Framework\App\Action\Context $context, \Magento\Store\Model\StoreManagerInterface $storeManager, \Custom\Appointment\Model\AppointmentFactory $appointmentFactory) {
        $this->appointmentFactory = $appointmentFactory;
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }

    public function execute() {
        $post = (array) $this->getRequest()->getPost();

        if (!empty($post)) {

            $baseUrl = $this->storeManager->getStore()->getBaseUrl();

            $appointmentFactory = $this->appointmentFactory->create();
            $appointmentFactory->setName($post['name']);
            $appointmentFactory->setEmail($post['email']);
            $appointmentFactory->setPhone($post['phone']);
            $appointmentFactory->setAppointmentdate($post['appointmentDate']);
            $appointmentFactory->save();

            $this->messageManager->addSuccessMessage('You have fixed an appointment on '.$post['appointmentDate']);

            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($baseUrl . 'appointment/');

            return $resultRedirect;
        }
    }

}
