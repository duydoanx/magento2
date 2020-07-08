<?php

namespace Magenest\Movie\Block;

use Magento\TestFramework\Event\Magento;
use Magento\Framework\View\Element\Template;

class CustomerInformarion extends Template
{
    private $customerSession;

    public function __construct(
        Template\Context $context,
        array $data = [],
        \Magento\Customer\Model\Session $customerSession
    ) {
        parent::__construct($context, $data);
        $this->customerSession = $customerSession;
    }

    public function getDetailsCurCustomer()
    {

        $customer = $this->customerSession->getCustomer();
        $customer_avatar = $customer->getData('customer_avatar');

        return [
            'avatar' => $customer_avatar,
            'name' => $customer->getName(),
            'email' => $customer->getEmail()
        ];
    }

}