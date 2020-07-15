<?php

namespace Magenest\CRUDSample\Block\Adminhtml\Edit;

use Magento\Framework\Registry;
use Magenest\CRUDSample\Controller\RegistryConstants;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context, \Magento\Framework\Registry $registry)
    {
        parent::__construct($context, $registry);
    }

    public function getButtonData()
    {
        $button = null;

        if ($this->registry->registry(RegistryConstants::IS_SAMPLE_EDIT_FORM)) {
            $button = [
                'label' => __('Delete Sample'),
                'class' => 'delete',
                'id' => 'sample-edit-delete-button',
                'data_attribute' => [
                    'url' => $this->getUrl('*/*/delete', ['id' => $this->getSampleId()])
                ],
                'on_click' => '',
                'sort_order' => 20,
            ];
        }

        return $button;
    }

}