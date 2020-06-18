<?php

namespace Custom\Grid\Block\Adminhtml\Employee\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveButton
 * @package Magento\Customer\Block\Adminhtml\Edit
 */
class SaveButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
       return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['employee' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }

}
