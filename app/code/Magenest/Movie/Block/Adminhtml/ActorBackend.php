<?php


namespace Magenest\Movie\Block\Adminhtml;


use Magento\Backend\Block\Widget\Grid\Container;

class ActorBackend extends Container
{
    public function __construct(\Magento\Backend\Block\Widget\Context $context, array $data = [])
    {
        $this->_blockGroup = 'Magenest_Movie';
        $this->_controller = 'adminhtml_actorbackend';
        parent::__construct($context, $data);
        $this->updateButton('add', 'label', 'New Actor');
        $this->updateButton('add', 'onclick', 'setLocation(\'' . $this->getUrl('movie/actorbackend/newactor') . '\')');
    }
}
