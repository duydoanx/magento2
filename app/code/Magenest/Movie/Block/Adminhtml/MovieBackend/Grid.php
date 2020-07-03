<?php


namespace Magenest\Movie\Block\Adminhtml\MovieBackend;


use Magenest\Movie\Model\ResourceModel\Movie\Collection;
use Magento\Backend\Block\Widget\Grid\Extended;
use phpDocumentor\Reflection\Types\This;
use SebastianBergmann\CodeCoverage\Report\Xml\Node;

class Grid extends Extended
{
    protected $_movieCollection;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        array $data = [],
        Collection $movieCollection
    )
    {
        parent::__construct($context, $backendHelper, $data);
        $this->_movieCollection = $movieCollection;
        $this->setEmptyText(__('No Movie Found'));
    }

    protected function _prepareCollection()
    {
        $this->setCollection($this->_movieCollection);
        return parent::_prepareCollection(); // TODO: Change the autogenerated stub
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'movie_id',
            [
                'header' => __('ID'),
                'index' => 'movie_id'
            ]
        );
        $this->addColumn(
            'movie_name',
            [
                'header' => __('Name'),
                'index' => 'name'
            ]
        );
        $this->addColumn(
            'movie_description',
            [
                'header' => __('Description'),
                'index' => 'description'
            ]
        );
        $this->addColumn(
            'movie_rating',
            [
                'header' => __('Rating'),
                'index' => 'rating'
            ]
        );
        $this->addColumn(
            'director_id',
            [
                'header' => __('Director ID'),
                'index' => 'director_id'
            ]
        );

    }
}
