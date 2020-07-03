<?php


namespace Magenest\Movie\Block\System\Config\Form\Field;


use Magenest\Movie\Model\ResourceModel\Actor\Collection;
use Magento\Config\Block\System\Config\Form\Field;

class ActorTableField extends Field
{
    protected $_actorCollection;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        array $data = [],
        Collection $actorCollection
    )
    {
        parent::__construct($context, $data);
        $this->_actorCollection = $actorCollection;
    }

    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $element->setData('value', $this->_actorCollection->getSize());
        $element->setReadonly(true);
        return $element->getElementHtml();
    }

}
