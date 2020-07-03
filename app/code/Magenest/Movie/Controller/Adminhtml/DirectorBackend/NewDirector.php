<?php


namespace Magenest\Movie\Controller\Adminhtml\DirectorBackend;


use Magento\Backend\App\Action;


class NewDirector extends Action
{
    protected $resultPageFactory;
    public function __construct(Action\Context $context)
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();

        $directorDatas = $this->getRequest()->getParam('director_details');
        if (is_array($directorDatas)) {
            $director = $this->_objectManager->create('Magenest\Movie\Model\Director');
            $director->setData($directorDatas)->save();
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index');
        }
    }
}
