<?php


namespace Magenest\Movie\Controller\Adminhtml\ActorBackend;


use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $pageResultFactory;

    public function __construct(Action\Context $context, PageFactory $pageResultFactory)
    {
        parent::__construct($context);
        $this->pageResultFactory = $pageResultFactory;
    }

    public function execute()
    {
        $resultPage = $this->pageResultFactory->create();
        $resultPage->setActiveMenu('Magenest_Movie::movie');
        $resultPage->getConfig()->getTitle()->prepend(__('Actor'));
        return $resultPage;
    }
}
