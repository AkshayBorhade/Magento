<?php
 
namespace Allure\Affiliate\Model\Account;

class Status implements \Magento\Framework\Option\ArrayInterface
{
    const ACTIVE = 1;
    const INACTIVE = 2;
    const NEED_APPROVED = 3;


    /**
     * to option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            [
                'value' => self::ACTIVE,
                'label' => __('Active')
            ],
            [
                'value' => self::INACTIVE,
                'label' => __('Inactive')
            ],
            [
                'value' => self::NEED_APPROVED,
                'label' => __('Need Approved')
            ],
        ];
        return $options;

    }
}
