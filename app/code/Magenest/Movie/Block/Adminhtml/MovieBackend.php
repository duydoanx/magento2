<?php


namespace Magenest\Movie\Block\Adminhtml;


use Magento\Backend\Block\Widget\Grid\Container;

class MovieBackend extends Container
{
    public function __construct(\Magento\Backend\Block\Widget\Context $context, array $data = [])
    {
        $this->_blockGroup = 'Magenest_Movie';
        $this->_controller = 'adminhtml_moviebackend';
        parent::__construct($context, $data);
        $this->updateButton('add', 'label', 'New Movie');
        $this->updateButton('add', 'onclick', 'setLocation(\'' . $this->getUrl('movie/moviebackend/newmovie') . '\')');
    }
}
