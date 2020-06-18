<?php

namespace Custom\Appointment\Controller\Index;

class Appointmentlist extends \Magento\Framework\App\Action\Action {

    public function execute() {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }

}
