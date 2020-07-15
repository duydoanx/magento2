<?php

namespace Magenest\CRUDSample\Model;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magenest\CRUDSample\Model\ResourceModel\Sample\CollectionFactory;

class SampleDataProvider extends AbstractDataProvider
{
    private $loadedData;

    public function __construct($name, $primaryFieldName, $requestFieldName, array $meta = [], array $data = [], CollectionFactory $collectionFactory)
    {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (!empty($this->loadedData)) {
            return $this->loadedData;
        }
        $this->loadedData = [];
        $items = $this->collection->getItems();
        foreach ($items as $item){
            $this->loadedData[$item->getId()]['sample-details'] = $item->getData();
        }
        return $this->loadedData;
    }
}