<?php

namespace Magenest\Movie\Model;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory;

class MovieDataProvider extends AbstractDataProvider
{
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        array $meta = [],
        array $data = [],
        CollectionFactory $movieCollectionFactory
    ) {
        $this->collection = $movieCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = array();
        foreach ($items as $movie) {
            $this->loadedData[$movie->getMovie_id()]['movie_details'] = $movie->getData();
        }

        return $this->loadedData;
    }
}
