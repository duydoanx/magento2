<?php

namespace Magenest\Movie\Block\System\Config\Form\Field;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magenest\Movie\Model\ResourceModel\Movie\Collection;
use Magento\Framework\Data\Form\Element\AbstractElement;

class MovieTableField extends Field
{
    protected $_movieCollection;

    public function __construct(
        Context $context,
        array $data = [],
        Collection $movieCollection
    ) {
        parent::__construct($context, $data);
        $this->_movieCollection = $movieCollection;
    }

    protected function _getElementHTML(AbstractElement $element)
    {

        $element->setReadonly(true);
        $element->setData('value', $length = $this->_movieCollection->getSize());

        return $element->getElementHtml();
    }
}
