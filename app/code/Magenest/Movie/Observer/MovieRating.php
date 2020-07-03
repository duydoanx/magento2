<?php


namespace Magenest\Movie\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class MovieRating implements ObserverInterface
{
    protected $_objectManager;
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager)
    {
        $this->_objectManager = $objectManager;
    }

    public function execute(Observer $observer)
    {
        $movie = $this->_objectManager->create('Magenest\Movie\Model\Movie');
        $movie->load($observer->getId());
        if ($movie->getRating() != 0) {
            $movie->setRating(0);
            $movie->save();
        }
        $observer->setData('test', 1234);
        return $this;
    }
}
