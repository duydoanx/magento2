<?php


namespace Magenest\Movie\Controller\Adminhtml\ActorBackend;


use Magento\Backend\App\Action;


class NewActor extends Action
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

        $actorDatas = $this->getRequest()->getParam('actor_details');
        if (is_array($actorDatas)) {
            $actor = $this->_objectManager->create('Magenest\Movie\Model\Actor');
            $actor->setData($actorDatas)->save();
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index');
        }
    }
}
