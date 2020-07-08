<?php

namespace Magenest\Movie\Block\Adminhtml\DirectorBackend;

use Magento\Backend\Helper\Data;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Grid\Extended;
use Magenest\Movie\Model\ResourceModel\Director\Collection;

class Grid extends Extended
{
    protected $_directorCollection;

    public function __construct(
        Context $context,
        Data $backendHelper,
        array $data = [],
        Collection $directorCollection
    ) {
        parent::__construct($context, $backendHelper, $data);
        $this->_directorCollection = $directorCollection;
        $this->setEmptyText(__('No Movie Found'));
    }

    protected function _prepareCollection()
    {
        $this->setCollection($this->_directorCollection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'director_id', [
                             'header' => __('ID'),
                             'index' => 'director_id'
                         ]);
        $this->addColumn(
            'director_name', [
                               'header' => __('Name'),
                               'index' => 'name'
                           ]);
    }
}
