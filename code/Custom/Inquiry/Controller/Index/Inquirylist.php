<?php

namespace Custom\Inquiry\Controller\Index;

class Inquirylist extends \Magento\Framework\App\Action\Action {

    public function execute() {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }

}
