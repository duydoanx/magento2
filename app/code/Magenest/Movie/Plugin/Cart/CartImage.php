<?php

namespace Magenest\Movie\Plugin\Cart;

use Psr\Log\LoggerInterface;
use Magento\Checkout\Controller\Cart\Add;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class CartImage
{
    public $productCollectionFactory;
    private $logger;

    public function __construct(
        LoggerInterface $logger,
        CollectionFactory $productCollectionFactory
    ) {
        $this->logger = $logger;
        $this->productCollectionFactory = $productCollectionFactory;
    }

    public function beforeExecute(Add $subject)
    {
        if ($_REQUEST['selected_configurable_option']) {
            $producId = $_REQUEST['selected_configurable_option'];
            $subject->getRequest()['product'] = $producId;
        }
    }

}
