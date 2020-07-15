<?php

namespace Magenest\Movie\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class OddEven extends Column
{
    public function prepareDataSource(array $dataSource)
    {
        foreach ($dataSource['data']['items'] as & $item){
            if ($item['entity_id'] % 2 == 0){
                $item['oddeven'] = html_entity_decode('<span class="grid-severity-notice"><span>Even</span></span>');
            }else{
                $item['oddeven'] = html_entity_decode('<span class="grid-severity-critical"><span>Odd</span></span>');
            }
        }
        return $dataSource;
    }
}