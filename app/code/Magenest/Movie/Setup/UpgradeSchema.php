<?php

namespace Magenest\Movie\Setup;

use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if(version_compare($context->getVersion(), '1.0.1', '<')) {
            $installer->getConnection()->addIndex(
                $setup->getTable('magenest_movie'),
                $setup->getIdxName('magenest_movie', ['name']),
                [
                    'name'
                ],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
        $installer->endSetup();
    }
}