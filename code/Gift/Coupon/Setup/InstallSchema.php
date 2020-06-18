<?php

namespace Gift\Coupon\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;


class InstallSchema implements InstallSchemaInterface
{
   
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        // Get tutorial_simplenews table
        $tableName = $installer->getTable('custom_gift');
        // Check if the table already exists
        if ($installer->getConnection()->isTableExists($tableName) != true) {
            // Create tutorial_simplenews table
            $table = $installer->getConnection()
                ->newTable($tableName)
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'ID'
                )
                ->addColumn(
                    'title',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Title'
                )
                ->addColumn(
                    'code',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Code'
                )
                ->addColumn(
                    'product_id',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'ProductId'
                )
                ->addColumn(
                    'order_id',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'OrderId'
                )
                ->addColumn(
                    'customer_id',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'CustomerId'
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_DATETIME,
                    null,
                    ['nullable' => false],
                    'Created At'
                )
                ->addColumn(
                    'status',
                    Table::TYPE_SMALLINT,
                    null,
                    ['nullable' => false, 'default' => '0'],
                    'Status'
                )
                ->addColumn(
                    'exp_date',
                    Table::TYPE_DATETIME,
                    null,
                    ['nullable' => false],
                    'Status'
                )
                ->setComment('Gift Code Table')
                ->setOption('type', 'InnoDB')
                ->setOption('charset', 'utf8');
            $installer->getConnection()->createTable($table);
        }

        
        
        $installer->getConnection()->addColumn(
                $installer->getTable('salesrule'),
                'gift_card_rule',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    
                    'comment' => 'Gift card rule'
                ]
            );
        
        $installer->endSetup();
        
        
     
        
    }
}