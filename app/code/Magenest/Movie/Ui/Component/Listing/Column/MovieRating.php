<?php

namespace Magenest\Movie\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class MovieRating extends Column
{
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (array_key_exists('rating', $item)) {
                    try {

                        $item[$this->getData('name')] = html_entity_decode($this->star2Html($item[$this->getData('name')], 5));

                    } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {

                    }

                }

            }
        }

        return $dataSource;
    }

    private function star2Html(int $quantity, int $max){
        $result = "";
        $quantity = $quantity>$max ? $max : $quantity;
        for ($i = 0; $i < $max; $i++){
            if ($i < $quantity){
                $result .= '<span class=\'icon-star-fill\'>&#9733;</span>';
            }else {
                $result .= '<span class=\'icon-star-empty\'>&#9733;</span>';
            }
        }
        return $result;
    }
}