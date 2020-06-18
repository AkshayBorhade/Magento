<?php

namespace Custom\Appointment\Block;

class Appointmentlist extends \Magento\Framework\View\Element\Template {

    public function __construct(
    \Magento\Backend\Block\Template\Context $context, array $data = [], \Custom\Appointment\Model\AppointmentFactory $appointmentFactory
    ) {
        parent::__construct($context, $data);
        $this->appointmentFactory = $appointmentFactory;
    }

    public function getAppointments() {
        $appointmentFactory = $this->appointmentFactory->create()->getCollection();
        return $appointmentFactory;
    }

}
