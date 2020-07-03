<?php


namespace Magenest\Movie\Plugin\Cart;


class CartImage
{
    private $logger;
    public $productCollectionFactory;

    public function __construct(\Psr\Log\LoggerInterface $logger,
                                \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
                                $productCollectionFactory)
    {
        $this->logger = $logger;
        $this->productCollectionFactory = $productCollectionFactory;
    }

//    public function beforeAddProduct($subject, $productInfo, $requestInfo){
//        if ($requestInfo['selected_configurable_option']){
//            $collection = $this->productCollectionFactory->create();
//            $product = $collection->getItemById($requestInfo['selected_configurable_option']);
//            $productInfo->setData($product->getData());
//            $requestInfo['product'] = $requestInfo['selected_configurable_option'];
//            $requestInfo['item'] = $requestInfo['selected_configurable_option'];
//            $requestInfo['selected_configurable_option'] = '';
//        }
//        return [$productInfo, $requestInfo];
//    }

    public function beforeExecute(\Magento\Checkout\Controller\Cart\Add $subject){
        if ($_REQUEST['selected_configurable_option']) {
            $producId = $_REQUEST['selected_configurable_option'];
            $subject->getRequest()->setParams(['product' => $producId]);
        }
    }

}
