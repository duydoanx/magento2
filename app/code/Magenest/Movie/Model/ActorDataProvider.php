<?php


namespace Magenest\Movie\Model;


use Magenest\Movie\Model\ResourceModel\Actor\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class ActorDataProvider extends AbstractDataProvider
{
    public function __construct($name, $primaryFieldName, $requestFieldName, array $meta = [], array $data = [],
                                CollectionFactory $actorCollectionFactory)
    {
        $this->collection = $actorCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = array();
        foreach ($items as $actor) {
            $this->loadedData[$actor->getActor_id()]['actor_details'] = $actor->getData();
        }
        return $this->loadedData;
    }
}
