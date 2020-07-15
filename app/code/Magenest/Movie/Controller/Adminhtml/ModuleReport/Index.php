<?php

namespace Magenest\Movie\Controller\Adminhtml\ModuleReport;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    private $pageResult;

    public function __construct(Action\Context $context, PageFactory $pageFactory)
    {
        $this->pageResult = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->pageResult->create();
        $resultPage->setActiveMenu('Magenest_Movie::movie');
        $resultPage->getConfig()->getTitle()->prepend(__('Module Report'));
        return $resultPage;
    }
}