<?php


namespace Magenest\Movie\Block\Adminhtml\ActorBackend;


use Magenest\Movie\Model\ResourceModel\Actor\Collection;
use Magento\Backend\Block\Widget\Grid\Extended;

class Grid extends Extended
{
    protected $_actorCollection;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        array $data = [],
        Collection $actorCollection
    )
    {
        parent::__construct($context, $backendHelper, $data);
        $this->_actorCollection = $actorCollection;
        $this->setEmptyText(__('No Movie Found'));
    }

    protected function _prepareCollection()
    {
        $this->setCollection($this->_actorCollection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'actor_id',
            [
                'header' => __('ID'),
                'index' => 'actor_id'
            ]
        );
        $this->addColumn(
            'actor_name',
            [
                'header' => __('Name'),
                'index' => 'name'
            ]
        );
    }
}
