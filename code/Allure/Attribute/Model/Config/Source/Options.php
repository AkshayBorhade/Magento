<?php

namespace Allure\Attribute\Model\Config\Source;

class Options extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
    * Get all options
    *
    * @return array
    */
    public function getAllOptions()
    {
        $this->_options = [
                ['Customer Aadhar Number' => __('No'), 'value'=>'0'],
                ['Customer Aadhar Number' => __('Yes'), 'value'=>'1'],
                ['Customer Aadhar Number' => __('Other'), 'value'=>'2']
            ];

    return $this->_options;

    }

}