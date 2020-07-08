<?php

namespace Magenest\Movie\Block\System\Config\Form\Field;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magenest\Movie\Model\ResourceModel\Actor\Collection;
use Magento\Framework\Data\Form\Element\AbstractElement;

class ActorTableField extends Field
{
    protected $_actorCollection;

    public function __construct(
        Context $context,
        array $data = [],
        Collection $actorCollection
    ) {
        parent::__construct($context, $data);
        $this->_actorCollection = $actorCollection;
    }

    protected function _getElementHtml(AbstractElement $element)
    {
        $element->setData('value', $this->_actorCollection->getSize());
        $element->setReadonly(true);

        return $element->getElementHtml();
    }

}
