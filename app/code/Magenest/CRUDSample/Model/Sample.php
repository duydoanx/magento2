<?php

namespace Magenest\CRUDSample\Model;

use Magento\Framework\Model\AbstractModel;

class Sample extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Magenest\CRUDSample\Model\ResourceModel\Sample');
    }
}