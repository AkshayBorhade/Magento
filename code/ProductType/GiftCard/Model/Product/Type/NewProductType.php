<?php
 
namespace ProductType\GiftCard\Model\Product\Type;
 
class NewProductType extends \Magento\Catalog\Model\Product\Type\AbstractType {
 
    const TYPE_ID = 'gift_card_product';
 
    public function deleteTypeSpecificData(\Magento\Catalog\Model\Product $product)
    {
        // method intentionally empty
    }
 
}