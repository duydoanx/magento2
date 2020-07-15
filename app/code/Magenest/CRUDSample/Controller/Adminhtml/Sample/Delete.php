<?php

namespace Magenest\CRUDSample\Controller\Adminhtml\Sample;

use Magento\Backend\App\Action;
use phpDocumentor\Reflection\Types\This;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Magenest\CRUDSample\Model\ResourceModel\SampleFactory as SampleResourceFactory;
use Magenest\CRUDSample\Model\ResourceModel\Sample\CollectionFactory;

class Delete extends Action
{
    protected $filter;

    protected $collectionFactory;

    protected $sampleResourceFactory;

    protected $sampleModelFactory;


    /**
     * Delete constructor.
     *
     * @param Action\Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param SampleResourceFactory $sampleResourceFactory
     * @param \Magenest\CRUDSample\Model\SampleFactory $sampleModelFactory
     */
    public function __construct(
        Action\Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        SampleResourceFactory $sampleResourceFactory,
        \Magenest\CRUDSample\Model\SampleFactory $sampleModelFactory
    ) {
        $this->sampleModelFactory = $sampleModelFactory;
        $this->sampleResourceFactory = $sampleResourceFactory;
        $this->collectionFactory = $collectionFactory;
        $this->filter = $filter;
        parent::__construct($context);
    }

    public function execute()
    {
        $resourceSample = $this->sampleResourceFactory->create();
        $modelSample = $this->sampleModelFactory->create();
        $collectionSample = $this->collectionFactory->create();
        if ($id = $this->getRequest()->getParam('id')){
            $resourceSample->delete($modelSample->setData($collectionSample->getItemById($id)->getData()));
        }else {
            $collection = $this->filter->getCollection($collectionSample);
            $sampleDeleted = 0;
            $sampleDeleteError = 0;
            foreach ($collection->getItems() as $item) {
                try {
                    $modelSample->setData($item->getData());
                    $resourceSample->delete($modelSample);
                    $sampleDeleted++;
                } catch (LocalizedException $exception) {
                    $sampleDeleteError++;
                }
            }
            if ($sampleDeleted) {
                $this->messageManager->addSuccessMessage(
                    __('A total of %1 record(s) have been deleted.', $sampleDeleted));
            }

            if ($sampleDeleteError) {
                $this->messageManager->addErrorMessage(
                    __(
                        'A total of %1 record(s) haven\'t been deleted. Please see server logs for more details.', $sampleDeleteError));
            }
        }

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');

    }
}