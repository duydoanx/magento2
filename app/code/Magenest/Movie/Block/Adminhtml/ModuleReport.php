<?php

namespace Magenest\Movie\Block\Adminhtml;

use Magento\Backend\Block\Template;

class ModuleReport extends Template
{

    private $moduleList;

    /**
     * ModuleReport constructor.
     *
     * @param Template\Context $context
     * @param array $data
     * @param \Magento\Framework\Module\FullModuleList $fullModuleList
     */
    public function __construct(Template\Context $context, array $data = [], \Magento\Framework\Module\FullModuleList $fullModuleList)
    {
        $this->moduleList = $fullModuleList;
        parent::__construct($context, $data);
    }

    public function getNumberOfInstalledModule(){
        return count($this->moduleList->getNames());
    }

    public function getNumOfExternalModule(){
        $listModuleName = $this->moduleList->getNames();
        $num = 0;
        foreach ($listModuleName as $moduleName){
            $magentoPrefix = substr($moduleName, 0, 7);
            if (strcmp($magentoPrefix, 'Magento') != 0){
                $num ++;
            }
        }
        return $num;
    }
}