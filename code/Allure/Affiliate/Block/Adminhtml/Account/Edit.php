<?php

namespace Allure\Affiliate\Block\Adminhtml\Account;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry
     * 
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * constructor
     * 
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Block\Widget\Context $context,
        array $data = []
    )
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize Account edit block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'account_id';
        $this->_blockGroup = 'Allure_Affiliate';
        $this->_controller = 'adminhtml_account';
        parent::_construct();
        $this->buttonList->update('save', 'label', __('Save Account'));
        $this->buttonList->add(
            'save-and-continue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => [
                            'event' => 'saveAndContinueEdit',
                            'target' => '#edit_form'
                        ]
                    ]
                ]
            ],
            -100
        );
    }
    /**
     * Retrieve text for header element depending on loaded Account
     *
     * @return string
     */
    public function getHeaderText()
    {
        /** @var \Allure\Affiliate\Model\Account $account */
        $account = $this->_coreRegistry->registry('Allure_affiliate_account');
        if ($account->getId()) {
            return __("Edit Account '%1'", $this->escapeHtml($account->getCustomer_id()));
        }
        return __('New Account');
    }
}
