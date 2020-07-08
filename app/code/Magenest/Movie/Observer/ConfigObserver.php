<?php

namespace Magenest\Movie\Observer;

use Magento\Framework\Event\Observer;
use Magento\PageCache\Model\Cache\Type;
use Magento\Framework\App\Cache\Type\Config;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;

class ConfigObserver implements ObserverInterface
{
    protected $config, $writer;
    protected $cacheTypeList;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        WriterInterface $writer,
        TypeListInterface $cacheTypeList
    ) {
        $this->config = $scopeConfig;
        $this->writer = $writer;
        $this->cacheTypeList = $cacheTypeList;
    }

    public function execute(Observer $observer)
    {
        if (array_search('movie/moviepage/text_field', $observer->getChanged_paths()) !== false) {
            if (strcmp($this->config->getValue('movie/moviepage/text_field'), 'Ping') == 0) {
                $this->writer->save('movie/moviepage/text_field', 'Pong');
                $this->cacheTypeList->cleanType(Config::TYPE_IDENTIFIER);
                $this->cacheTypeList->cleanType(Type::TYPE_IDENTIFIER);
            }
        }

        return $this;
    }
}
