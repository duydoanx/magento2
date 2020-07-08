<?php

namespace Magenest\Movie\Block\System\Config;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Button extends Field
{
    protected $_template = 'Magenest_Movie::system/config/button.phtml';

    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function render(AbstractElement $element)
    {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();

        return parent::render($element);
    }

    public function getButtonHtml()
    {
        $button = $this->getLayout()->createBlock(
            'Magento\Backend\Block\Widget\Button')->setData(
            [
                'id' => 'btn_id',
                'class' => 'secondary',
                'label' => __('Reload'),
            ]);
        $html = $button->toHtml();
        $html .= "<script>document.getElementById('btn_id').onclick = function() {location.reload();}</script>";

        return $html;
    }

    protected function _getElementHtml(AbstractElement $element)
    {
        return $this->_toHtml();
    }
}
