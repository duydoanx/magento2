<?php

namespace Magenest\CRUDSample\Controller\Adminhtml\Sample;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    private $pageFactoryResult;

    public function __construct(Action\Context $context, PageFactory $pageFactory)
    {
        $this->pageFactoryResult = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->pageFactoryResult->create();
        $resultPage->getConfig()->getTitle()->set('Sample CRUD Page');
        $resultPage->setActiveMenu('Magenest_CRUDSample::crud_sample');
        return $resultPage;
    }
}