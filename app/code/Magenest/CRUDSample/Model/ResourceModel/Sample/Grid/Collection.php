<?php

namespace Magenest\CRUDSample\Model\ResourceModel\Sample\Grid;

use Psr\Log\LoggerInterface as Logger;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;

class Collection extends SearchResult
{
    public function __construct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,
        $identifierName = null,
        $connectionName = null
    ) {
        $mainTable = 'sample_table';
        $this->_init('Magenest\CRUDSample\Model\Sample', 'Magenest\CRUDSample\Model\ResourceModel\Sample');
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $this->_resourceModel, $identifierName, $connectionName);
    }

}