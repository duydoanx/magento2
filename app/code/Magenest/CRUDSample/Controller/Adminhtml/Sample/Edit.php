<?php

namespace Magenest\CRUDSample\Controller\Adminhtml\Sample;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;
use Magenest\CRUDSample\Controller\RegistryConstants;
use Magenest\CRUDSample\Model\ResourceModel\Sample\CollectionFactory;

class Edit extends Action
{

    private $pageFactoryResult;
    private $registry;
    private $collectionFactory;

    public function __construct(
        Action\Context $context,
        PageFactory $pageFactory,
        \Magento\Framework\Registry $registry,
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->registry = $registry;
        $this->pageFactoryResult = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $sampleCollection = $this->collectionFactory->create();
        if ($id = $this->getRequest()->getParam('id', false) and $sampleCollection->getItemById($id)) {
            $this->registry->register(RegistryConstants::IS_SAMPLE_EDIT_FORM, true);
            $this->registry->register(RegistryConstants::CURRENT_SAMPLE_ID, $this->getRequest()->getParam('id'));
            $resultPage = $this->pageFactoryResult->create();
            $resultPage->getConfig()->getTitle()->set('Edit Sample Page');
        } else {
            if ($this->getRequest()->getParam('new')) {
                $this->registry->register(RegistryConstants::IS_SAMPLE_EDIT_FORM, false);
                $resultPage = $this->pageFactoryResult->create();
                $resultPage->getConfig()->getTitle()->set('New Sample Page');

            } else {
                $this->_redirect('*/*/');
            }
        }
        $resultPage->setActiveMenu('Magenest_CRUDSample::crud_sample');

        return $resultPage;
    }
}