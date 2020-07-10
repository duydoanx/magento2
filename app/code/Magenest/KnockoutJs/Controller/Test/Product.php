<?php

namespace Magenest\KnockoutJs\Controller\Test;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollection;
use Magento\Catalog\Helper\Image;
use Magento\Store\Model\StoreManager;

class Product extends \Magento\Framework\App\Action\Action
{
    protected $productCollectionFactory;
    protected $imageHelper;
    protected $listProduct;
    protected $_storeManager;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Data\Form\FormKey $formKey,
        ProductCollection $productCollectionFactory,
        StoreManager $storeManager,
        Image $imageHelper
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->imageHelper = $imageHelper;
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

//    public function getCollection()
//    {
//        return $this->productFactory->create()->getCollection()->addAttributeToSelect('*')->setPageSize(5)->setCurPage(1);
//    }

    public function execute()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            $productCollection = $this->productCollectionFactory->create();
            $productCollection->addAttributeToSelect(["name", 'image', 'price'],'inner');

            $productCollection->getAllIds();
            $product = $productCollection->getItemById($id);
            $productData = [
                'entity_id' => $product->getId(),
                'name' => $product->getName(),
                'price' => '$' . $product->getPrice(),
                'src' => $this->imageHelper->init($product, 'product_base_image')->getUrl(),
            ];
            echo json_encode($productData);

            return;
        }
    }
}