<?php

namespace Allure\Affiliate\Block\Adminhtml\Banner\Edit;

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
        $this->setId('banner_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Banner Information'));
    }
}
