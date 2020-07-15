<?php

namespace Magenest\CRUDSample\Controller\Adminhtml\Sample;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class InlineEdit extends Action
{
    private $jsonFactory;

    public function __construct(Context $context, \Magento\Framework\Controller\Result\JsonFactory $jsonFactory)
    {
        $this->jsonFactory = $jsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $messages = [];
        $error = false;

        if ($this->getRequest()->getParams('isAjax')) {
            $samplePost = $this->getRequest()->getParam('items');
            if (!count($samplePost)) {
                $messages[] = __('Please send correct data!');
                $error = true;
            } else {
                foreach (array_keys($samplePost) as $entityId) {
                    /** load your model to update the data */
                    $model = $this->_objectManager->create('Magenest\CRUDSample\Model\Sample')->load($entityId);
                    try {
                        $model->setData(array_merge($model->getData(), $samplePost[$entityId]));
                        $model->save();
                    } catch (\Exception $e) {
                        $messages[] = "[Error:]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData(
            [
                'messages' => $messages,
                'error' => $error
            ]);
    }
}