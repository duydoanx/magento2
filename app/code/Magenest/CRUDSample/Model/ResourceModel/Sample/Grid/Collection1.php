<?php

namespace Magenest\CRUDSample\Model\ResourceModel\Sample\Grid;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Psr\Log\LoggerInterface as Logger;

/**
 * Class Collection1
 *
 * @package Magenest\CRUDSample\Model\ResourceModel\Sample\Grid
 *
 * @deprecated this's test class
 */

class Collection1 extends AbstractCollection implements SearchResultInterface
{

    protected $aggregations;
    protected $searchCriteria;
    protected $totalCount;
    protected $resourceConnection;

    public function __construct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,
        $identifierName = null,
        $connectionName = null
    ) {
        $this->_init('Magenest\CRUDSample\Model\Sample', 'Magenest\CRUDSample\Model\ResourceModel\Sample');
        $this->setMainTable(true);
//        $this->_resource
//        if ($connectionName) {
//            $connection  = $this->getResourceConnection()->getConnectionByName($connectionName);
//        } else {
//            $connection = $this->getResourceConnection()->getConnection();
//        }
//        $this->setMainTable($this->getResourceConnection()->getTableName('sample_table'));
        $this->setMainTable('sample_table');
        $this->identifierName = $identifierName;
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            null,
            null
        );
        $this->_setIdFieldName('id');
    }

    public function setItems(array $items = null)
    {
        if ($items) {
            foreach ($items as $item) {
                $this->addItem($item);
            }
            unset($this->totalCount);
        }
        return $this;
    }

    public function getAggregations()
    {
        return $this->aggregations;
    }

    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
    }

    public function getSearchCriteria()
    {
        return $this->searchCriteria;
    }

    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria)
    {
        $this->searchCriteria = $searchCriteria;
        return $this;
    }

    public function getTotalCount()
    {
        if (!$this->totalCount) {
            $this->totalCount = $this->getSize();
        }
        return $this->totalCount;
    }

    public function setTotalCount($totalCount)
    {
        return $this;
    }
}