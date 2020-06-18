<?php

namespace Allure\Affiliate\Block\Adminhtml\Campaign\Edit;

/**
 * @method Tabs setTitle(\string $title)
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('campaign_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Campaign Information'));
    }
}
