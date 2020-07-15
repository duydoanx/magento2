<?php

namespace Magenest\Movie\Model\Director;

use Magento\Framework\Data\OptionSourceInterface;

class Option implements OptionSourceInterface
{
    private $directorCollectionFactory;
    public function __construct(\Magenest\Movie\Model\ResourceModel\Director\CollectionFactory $directorCollectionFactory)
    {
        $this->directorCollectionFactory = $directorCollectionFactory;
    }

    public function toOptionArray()
    {
        $result = [];

        $directors = $this->directorCollectionFactory->create()->getData();
        foreach ($directors as $director){
            array_push($result, ['value' => $director['director_id'], 'label' => $director['name']]);
        }

        return $result;
    }
}