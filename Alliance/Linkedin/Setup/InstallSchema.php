<?php
namespace Alliance\Linkedin\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ){
        $setup->startSetup();

        $quote = $setup->getTable('quote_address');
        $salesOrder = $setup->getTable('sales_order_address');


        $setup->getConnection()->addColumn(
            $quote,
            'linkedin',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'nullable' => true,
                'comment' =>'Custom Notes'
            ]
        );

        $setup->getConnection()->addColumn(
            $salesOrder,
            'linkedin',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'nullable' => true,
                'comment' =>'Custom Notes'
            ]
        );

        $setup->endSetup();
    }
}
