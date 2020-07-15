<?php

namespace Magenest\CRUDSample\Controller\Adminhtml\Sample;

use Magento\Backend\App\Action;

class NewAction extends Action
{
    public function execute()
    {
        $params = $this->getRequest()->getParams();
        $params['new'] = true;
        $this->_forward('Edit', null, null, $params);
    }
}