<?php


namespace Magenest\Movie\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CustomerChangeName implements ObserverInterface
{
    protected $_customerRepositoryInterface;
    protected $logger;
    protected $customer;
    public function __construct(\Psr\Log\LoggerInterface $logger,
                                \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface
    )
    {
        $this->logger = $logger;
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
    }

    public function execute(Observer $observer)
    {
        $this->logger->debug('First Name is Changed!');
        $customer = $observer->getCustomerDataObject();
        $customerId = $customer->getId();
        if (strcmp($customer->getFirstName(), 'Magenest') != 0) {
            $customerData = $this->_customerRepositoryInterface->getById($customerId);
            $customerData->setFirstName('Magenest');
            $this->_customerRepositoryInterface->save($customerData);
        }
        return $this;
    }
}
