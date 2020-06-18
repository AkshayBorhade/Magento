<?php declare(strict_types=1);

/**
 * Patch to create Customer Address Attribute
 *
 * 
 *
 * @author 
 * @package 
 */

namespace Allure\Shipping\Setup\Patch\Data;

use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Class AddressAttribute
 */
class AddressAttribute implements DataPatchInterface
{
    /**
     * @var Config
     */
    private $eavConfig;

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * AddressAttribute constructor.
     *
     * @param Config              $eavConfig
     * @param EavSetupFactory     $eavSetupFactory
     */
    public function __construct(
        Config $eavConfig,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->eavConfig = $eavConfig;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $eavSetup = $this->eavSetupFactory->create();

        $eavSetup->addAttribute('customer_address', 'frontname', [
            'type'             => 'varchar',
            'input'            => 'text',
            'label'            => 'frontname',
            'visible'          => true,
            'required'         => false,
            'user_defined'     => true,
            'system'           => false,
            'group'            => 'General',
            'global'           => true,
            'visible_on_front' => true,
        ]);

        $customAttribute = $this->eavConfig->getAttribute('customer_address', 'frontname');

        $customAttribute->setData(
            'used_in_forms',
            ['adminhtml_customer_address',
             'customer_address_edit',
             'customer_register_address']
        );
        $customAttribute->save();
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases(): array
    {
        return [];
    }
}