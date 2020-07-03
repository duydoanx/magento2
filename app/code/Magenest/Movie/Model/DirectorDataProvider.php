<?php


namespace Magenest\Movie\Model;


use Magenest\Movie\Model\ResourceModel\Director\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DirectorDataProvider extends AbstractDataProvider
{
    public function __construct($name, $primaryFieldName, $requestFieldName, array $meta = [], array $data = [],
                                CollectionFactory $directorCollectionFactory)
    {
        $this->collection = $directorCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = array();
        foreach ($items as $director) {
            $this->loadedData[$director->getDirector_id()]['director_details'] = $director->getData();
        }
        return $this->loadedData;
    }
}
