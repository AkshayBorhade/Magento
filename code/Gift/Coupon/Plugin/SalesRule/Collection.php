<?php
namespace Gift\Coupon\Plugin\SalesRule;

class Collection
{

    public function after_initSelect(\Magento\SalesRule\Model\ResourceModel\Rule\Collection $subject, $result)
    {
        $select = $result->getSelect();
                 
        $select->where('main_table.gift_card_rule IS NULL');
        
        return $this;
    }
}