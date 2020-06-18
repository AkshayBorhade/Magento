<?php

namespace Custom\Design\Block\Adminhtml\System\Config;

use Magento\Framework\Registry;

class Date extends \Magento\Config\Block\System\Config\Form\Field {

    /**
     * @var  Registry
     */
    protected $_coreRegistry;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param Registry $coreRegistry
     * @param array $data
     */
    public function __construct(
    \Magento\Backend\Block\Template\Context $context, Registry $coreRegistry, array $data = []
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
    }

    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element) {

        $baseURL = $this->getBaseUrl();
        $html = $element->getElementHtml();
        
        $html .= '<script type="text/javascript">
            require(["jquery", "jquery/ui"], function () {
                jQuery(document).ready(function () {
                	// alert(1);
                    jQuery("#' . $element->getHtmlId() . '").datepicker( { dateFormat: "dd/mm/yy" } );
                        
                    var el = document.getElementById("' . $element->getHtmlId() . '");
                    el.className = el.className + " datepicker";
                });
            });
            </script>';
        return $html;
    }

}