<?php


namespace Magenest\Movie\Model\Config\Source;


class MovieSource implements \Magento\Framework\Data\OptionSourceInterface
{

    public function toOptionArray()
    {
        return [
            [
                'label' => 'show',
                'value' => 1
            ],
            [
                'label' => 'not-show',
                'value' => 2
            ]
        ];
    }
}
