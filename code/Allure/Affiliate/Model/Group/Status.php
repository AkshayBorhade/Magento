<?php
 
namespace Allure\Affiliate\Model\Group;

class Status implements \Magento\Framework\Option\ArrayInterface
{
    const ENABLED = 1;
    const DISABLED = 2;


    /**
     * to option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            [
                'value' => self::ENABLED,
                'label' => __('Enabled')
            ],
            [
                'value' => self::DISABLED,
                'label' => __('Disabled')
            ],
        ];
        return $options;

    }
}
