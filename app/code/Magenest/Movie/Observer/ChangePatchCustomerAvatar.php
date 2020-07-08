<?php

namespace Magenest\Movie\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;

class ChangePatchCustomerAvatar implements ObserverInterface
{
    private $customer;

    public function __construct(CustomerRepositoryInterface $customer)
    {
        $this->customer = $customer;
    }

    public function execute(Observer $observer)
    {
        $avatarPath = $observer->getCustomer()->getCustomAttribute('customer_avatar')->getValue();
        $customer = $this->customer->getById($observer->getCustomer()->getId());
        $customer->setCustomAttribute('customer_avatar', '/pub/media/customer'.$avatarPath);
        $this->customer->save($customer);
    }
}