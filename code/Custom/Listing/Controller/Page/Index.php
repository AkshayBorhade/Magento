<?php

namespace Custom\Listing\Controller\Page;

class Index extends \Magento\Framework\App\Action\Action
{

	public function __construct(
    \Magento\Framework\App\Action\Context $context,\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory) {
        parent::__construct($context);
        $this->productCollectionFactory=$productCollectionFactory;
    }

    public function execute()
    {
     $collection = $this->productCollectionFactory->create();
    echo "<b>Product</b></br>";
     foreach ($collection as $product) {
			echo $product->getSku();
            echo "</br>";
         } 
        
    }     
}