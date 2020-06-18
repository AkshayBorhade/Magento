<?php

/*
 * This data patch used to add custom attribute to product
 */

namespace Allure\Attribute\Setup\Patch\Data;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Eav\Model\AttributeRepository;

class AddCustomAttribute implements DataPatchInterface {

    /** @var ModuleDataSetupInterface */
    private $moduleDataSetup;

    /** @var EavSetupFactory */
    private $eavSetupFactory;
    private $AttributeRepository;
    protected $salesSetupFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
    ModuleDataSetupInterface $moduleDataSetup, EavSetupFactory $eavSetupFactory, AttributeRepository $attributeRepository, \Magento\Sales\Setup\SalesSetupFactory $salesSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->attributeRepository = $attributeRepository;
        $this->salesSetupFactory = $salesSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function apply() {

        $setup = $this->moduleDataSetup;

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        ///////////// Remove/Add customize attribute  /////////////

        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'productcode');

        $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY, 'productcode', [
            'type' => 'int',
            'backend' => '',
            'frontend' => '',
            'label' => 'productcode',
            'input' => 'select',
            'class' => '',
            'source' => 'Allure\Attribute\Model\Config\Source\Options',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => false,
            'default' => '',
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'unique' => false,
            'apply_to' => ''
                ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies() {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases() {
        return [];
    }

}
