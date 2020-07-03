<?php


namespace Magenest\Movie\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ConfigObserver implements ObserverInterface
{
    protected $config, $writer;
    protected $cacheTypeList;

    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
                                \Magento\Framework\App\Config\Storage\WriterInterface $writer,
                                \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList)
    {
        $this->config = $scopeConfig;
        $this->writer = $writer;
        $this->cacheTypeList = $cacheTypeList;
    }

    public function execute(Observer $observer)
    {
        if (array_search('movie/moviepage/text_field',$observer->getChanged_paths()) !== false){
            if (strcmp($this->config->getValue('movie/moviepage/text_field'), 'Ping') == 0){
                $this->writer->save('movie/moviepage/text_field', 'Pong');
                $this->cacheTypeList
                    ->cleanType(\Magento\Framework\App\Cache\Type\Config::TYPE_IDENTIFIER);
                $this->cacheTypeList
                    ->cleanType(\Magento\PageCache\Model\Cache\Type::TYPE_IDENTIFIER);
            }
        }
        return $this;
    }
}
