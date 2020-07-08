<?php

namespace Magenest\Movie\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        //Create Director Table
        if (!$installer->tableExists('magenest_director')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_director'))->addColumn(
                'director_id', Table::TYPE_INTEGER, null, [
                                     'identity' => true,
                                     'nullable' => false,
                                     'primary' => true,
                                     'unsigned' => true
                                 ], 'Director ID')->addColumn(
                'name', Table::TYPE_TEXT, 255, ['nullable' => false], 'Director Name')->setComment('Director Table');
            $installer->getConnection()->createTable($table);
        }
        //End create Director Table

        //Create Movie Table
        if (!$installer->tableExists('magenest_movie')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_movie'))->addColumn(
                'movie_id', Table::TYPE_INTEGER, null, [
                                  'identity' => true,
                                  'nullable' => false,
                                  'primary' => true,
                                  'unsigned' => true
                              ], 'Movie ID')->addColumn(
                'name', Table::TYPE_TEXT, 255, ['nullable' => false], 'Movie Name')->addColumn(
                'description', Table::TYPE_TEXT, 1000, ['nullable' => true], 'Movie Description')->addColumn(
                'rating', Table::TYPE_INTEGER, null, ['nullable' => true], 'Movie Rating')->addColumn(
                'director_id', Table::TYPE_INTEGER, null, [
                                     'nullable' => false,
                                     'unsigned' => true
                                 ], 'Movie Director ID')->addForeignKey( // Add foreign key for table entity
                    $installer->getFkName(
                        'magenest_movie', // New table
                        'director_id', // Column in New Table
                        'magenest_director', // Reference Table
                        'director_id' // Column in Reference table
                    ), 'director_id', // New table column
                    $installer->getTable('magenest_director'), // Reference Table
                    'director_id', // Reference Table Column
                    // When the parent is deleted, delete the row with foreign key
                    Table::ACTION_CASCADE)->setComment('Movie Table');
            $installer->getConnection()->createTable($table);
        }
        //End create Movie Table

        //Create Actor Table
        if (!$installer->tableExists('magenest_actor')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_actor'))->addColumn(
                'actor_id', Table::TYPE_INTEGER, null, [
                                  'identity' => true,
                                  'nullable' => false,
                                  'primary' => true,
                                  'unsigned' => true
                              ], 'Actor ID')->addColumn(
                'name', Table::TYPE_TEXT, 255, ['nullable' => false], 'Actor Name')->setComment('Actor Table');
            $installer->getConnection()->createTable($table);
        }
        //End create Actor Table

        //Create Movie Actor Table
        if (!$installer->tableExists('magenest_movie_actor')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_movie_actor'))->addColumn(
                'movie_id', Table::TYPE_INTEGER, null, [
                                  'nullable' => false,
                                  'unsigned' => true
                              ], 'Movie ID')->addColumn(
                'actor_id', Table::TYPE_INTEGER, null, [
                                  'nullable' => false,
                                  'unsigned' => true
                              ], 'Actor ID')->addForeignKey( // Add foreign key for table entity
                    $installer->getFkName(
                        'magenest_movie_actor', // New table
                        'movie_id', // Column in New Table
                        'magenest_movie', // Reference Table
                        'movie_id' // Column in Reference table
                    ), 'movie_id', // New table column
                    $installer->getTable('magenest_movie'), // Reference Table
                    'movie_id', // Reference Table Column
                    // When the parent is deleted, delete the row with foreign key
                    Table::ACTION_CASCADE)->addForeignKey( // Add foreign key for table entity
                    $installer->getFkName(
                        'magenest_movie_actor', // New table
                        'actor_id', // Column in New Table
                        'magenest_actor', // Reference Table
                        'actor_id' // Column in Reference table
                    ), 'actor_id', // New table column
                    $installer->getTable('magenest_actor'), // Reference Table
                    'actor_id', // Reference Table Column
                    // When the parent is deleted, delete the row with foreign key
                    Table::ACTION_CASCADE)->setComment('Movie Actor Table');
            $installer->getConnection()->createTable($table);
        }
        //End create Movie Actor Table

        $installer->endSetup();
    }
}
