<?php

namespace Custom\Listing\Block;

class Listing extends \Magento\Framework\View\Element\Template {

    public function __construct(
    \Magento\Backend\Block\Template\Context $context, array $data = [],\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,\Magento\CatalogInventory\Model\Stock\StockItemRepository $stockItemRepository,\Magento\Catalog\Model\ProductRepository $productRepository,\Magento\Customer\Model\CustomerFactory $customerFactory) {
        parent::__construct($context, $data);
        $this->productCollectionFactory=$productCollectionFactory;
        $this->stockItemRepository = $stockItemRepository;
        $this->productRepository = $productRepository;
        $this->customerFactory = $customerFactory;
    }

  public function getListing() {
    $productList=array();
    $i=0;
         $collection = $this->productCollectionFactory->create();
         foreach ($collection as $product) {
          $productList[$i]['price'] = $this->productRepository->get($product->getSku());
          $productList[$i]['qty']= $this->stockItemRepository->get($product->getId());
          $productList[$i]['sku']=$product->getSku();
          $i++;
         }
         
         return $productList;
    }

    public function getUser() {
        
        $collection=$this->customerFactory->create()->getCollection();
        return $collection;
    }


}
