<?php

namespace Magenest\KnockoutJs\Controller\Test;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{

    private $resultPageFactory;

    /**
     * Index constructor.
     *
     * @param \Magento\Store\App\Action\Plugin\Context $context
     * @param PageFactory $pageFactory
     */
    /*public function __construct(
        \Magento\Store\App\Action\Plugin\Context $context,
        PageFactory $pageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $pageFactory;
    }*/

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