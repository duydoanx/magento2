<?php

namespace Magenest\CRUDSample\Model\ResourceModel\Sample;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
    protected function _construct()
    {
        $this->_init('Magenest\CRUDSample\Model\Sample', 'Magenest\CRUDSample\Model\ResourceModel\Sample');
    }
}