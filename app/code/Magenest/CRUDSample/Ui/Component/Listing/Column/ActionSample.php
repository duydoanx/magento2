<?php

namespace Magenest\CRUDSample\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use function Symfony\Component\String\u;

class ActionSample extends Column
{
    private $url;

    public function __construct(ContextInterface $context, UiComponentFactory $uiComponentFactory, array $components = [], array $data = [], \Magento\Framework\UrlInterface $url)
    {
        $this->url = $url;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')]['edit'] = [
                    'href' => $this->url->getUrl(
                        'crudsample/sample/edit',
                        ['id' => $item['id']]
                    ),
                    'label' => __('Edit'),
                    'hidden' => false,
                    '__disableTmpl' => true
                ];
            }
        }

        return $dataSource;
    }
}