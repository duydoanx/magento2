<?php

namespace Magenest\FrontendTest\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $resultPageFactory;
    public function __construct(Context $context, PageFactory $pageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $pageFactory;
    }

    public function execute()
    {
        $pageResult = $this->resultPageFactory->create();
        return $pageResult;
    }
}