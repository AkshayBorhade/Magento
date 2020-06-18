<?php

namespace Allure\Affiliate\Block\Adminhtml\Account;

/**
 * Class Create
 * @package Allure\Affiliate\Block\Adminhtml\Transaction
 */
class Create extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Constructor
     *
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
    }

    /**
     * Initialize Transaction create block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_blockGroup = 'Allure_Affiliate';
        $this->_controller = 'adminhtml_account';
        parent::_construct();

        $customerId = $this->_backendSession->getData('account_customer_id');

        $this->buttonList->update('save', 'label', __('Save Account'));
        $this->buttonList->update('back', 'id', 'back_account_top_button');
        $this->buttonList->update('save', 'id', 'save_account_top_button');

        $this->buttonList->update('reset', 'id', 'reset_account_top_button');
        $this->buttonList->update('reset', 'label', __('Cancel'));
        $this->buttonList->update('reset', 'class', 'cancel');
        $this->buttonList->update('reset', 'onclick', 'setLocation(\'' . $this->getCancelUrl() . '\')');

        if ($customerId === null) {
            $this->buttonList->update('reset', 'style', 'display:none');
            $this->buttonList->update('save', 'style', 'display:none');
        } else {
            $this->buttonList->update('back', 'style', 'display:none');
        }

        $this->buttonList->remove('delete');
    }

    /**
     * Retrieve text for header element depending on loaded Transaction
     *
     * @return string
     */
    public function getHeaderText()
    {
        return __('New Account');
    }

    /**
     * Get cancel url
     *
     * @return string
     */
    public function getCancelUrl()
    {
        return $this->getUrl('affiliate/account_create/cancel');
    }
}
