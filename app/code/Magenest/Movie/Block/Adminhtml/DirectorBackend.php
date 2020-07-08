<?php

namespace Magenest\Movie\Block\Adminhtml;

use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Grid\Container;

class DirectorBackend extends Container
{
    public function __construct(Context $context, array $data = [])
    {
        $this->_blockGroup = 'Magenest_Movie';
        $this->_controller = 'adminhtml_directorbackend';
        parent::__construct($context, $data);
        $this->updateButton('add', 'label', 'New Director');
        $this->updateButton('add', 'onclick', 'setLocation(\'' . $this->getUrl('movie/directorbackend/newdirector') . '\')');
    }
}
