<?php

namespace Magenest\CRUDSample\Setup;

use Magento\Setup\Exception;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * @var \Magento\Framework\Setup\SchemaSetupInterface $installer
     */
    private $installer;

    /**
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->installer = $setup;
        $this->installer->startSetup();
        $this->installer->getConnection()->createTable($this->createSampleTable());
        $this->installer->endSetup();
    }

    private function createTable($tableName, $primaryKey, $tableComment = '')
    {
        $table = $this->installer->getConnection()->newTable(
            $this->installer->getTable($tableName))->addColumn(
            $primaryKey, Table::TYPE_INTEGER, null, [
            'identity' => true,
            'nullable' => false,
            'primary' => true,
            'unsigned' => true
        ], $primaryKey)->setComment(empty($tableComment) ? $tableName : $tableComment);

        return $table;
    }

    private function createSampleTable()
    {
        $tableName = 'sample_table';
        if (!$this->installer->tableExists($tableName)) {
            $table = $this->createTable($tableName, 'id');
            $table->addColumn('field1', Table::TYPE_TEXT, 255, ['nullable' => false], 'Sample table field 1')
                ->addColumn('field2', Table::TYPE_TEXT, 255, ['nullable' => false], 'Sample table field 2');
            return $table;
        }else{
            throw new Exception('Table '.$tableName.' already exists');
        }

    }
}