<?php

namespace First\Module\Controller\Page;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use First\Module\Api\PencilInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;

class Hello extends \Magento\Framework\App\Action\Action {
protected $pencilInterface;
protected $productRepository;

public function __construct(Context $context,PencilInterface $pencilInterface,ProductRepositoryInterface $productRepository) {
        $this->pencilInterface=$pencilInterface;
        $this->productRepository=$productRepository;
        parent::__construct($context);
    }
public function execute() {
    echo $this->pencilInterface->getPencilType();
	//echo get_class($this->productRepository);
    }
}