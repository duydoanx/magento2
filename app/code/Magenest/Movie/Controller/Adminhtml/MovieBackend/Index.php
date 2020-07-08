<?php

namespace Magenest\Movie\Controller\Adminhtml\MovieBackend;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $resultPageFactory;

    public function __construct(Action\Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Magenest_Movie::movie');
        $resultPage->getConfig()->getTitle()->prepend(__('Movie'));

        return $resultPage;
    }
}
