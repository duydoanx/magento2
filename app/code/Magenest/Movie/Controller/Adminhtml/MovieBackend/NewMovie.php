<?php

namespace Magenest\Movie\Controller\Adminhtml\MovieBackend;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class NewMovie extends Action
{
    protected $resultPageFactory;

    public function __construct(Action\Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        //        $resultPage = $this->resultPageFactory->create();
        //        $resultPage->setActiveMenu('Magenest_Movie::movie');
        //        $resultPage->getConfig()->getTitle()->prepend(__('Movie'));
        //        return $resultPage;
        $this->_view->loadLayout();
        $this->_view->renderLayout();

        $movieDatas = $this->getRequest()->getParam('movie_details');
        if (is_array($movieDatas)) {
            /** @var \Magenest\Movie\Model\Movie $movie */
            $movie = $this->_objectManager->create('Magenest\Movie\Model\Movie');
            $movieResourceModel = $this->_objectManager->create('Magenest\Movie\Model\ResourceModel\Movie');
            $movie->setData($movieDatas);
            $movieResourceModel->save($movie);
            $resultRedirect = $this->resultRedirectFactory->create();

            return $resultRedirect->setPath('*/*/index');
        }
    }
}
