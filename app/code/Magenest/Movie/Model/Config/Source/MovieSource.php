<?php

namespace Magenest\Movie\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class MovieSource implements OptionSourceInterface
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
