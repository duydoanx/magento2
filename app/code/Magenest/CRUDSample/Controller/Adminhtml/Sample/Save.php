<?php

namespace Magenest\CRUDSample\Controller\Adminhtml\Sample;

use Magento\Backend\App\Action;
use Magenest\CRUDSample\Model\SampleFactory as SampleModelFactory;
use Magenest\CRUDSample\Model\ResourceModel\SampleFactory as SampleResourceFactory;

class Save extends Action
{
    private $sampleResourceFactory;
    private $sampleModelFactory;

    public function __construct(Action\Context $context, SampleResourceFactory $sampleResourceFactory, SampleModelFactory $sampleModelFactory)
    {
        $this->sampleResourceFactory = $sampleResourceFactory;
        $this->sampleModelFactory = $sampleModelFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        if ($sample = $this->getRequest()->getParam('sample-details')) {
            $sampleResource = $this->sampleResourceFactory->create();
            $sampleModel = $this->sampleModelFactory->create();
            $sampleModel->setData($sample);
            $sampleResource->save($sampleModel);
            $this->_redirect('*/*/index');
        }else{
            $this->_redirect('*/*/new', $sample);
        }
    }
}