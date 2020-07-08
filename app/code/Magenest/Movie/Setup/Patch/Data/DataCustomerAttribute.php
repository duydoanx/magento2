<?php

namespace Magenest\Movie\Setup\Patch\Data;

use Magento\Customer\Model\Customer;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\Patch\PatchInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;

class DataCustomerAttribute implements DataPatchInterface
{

    private $moduleDataSetup;
    private $customerSetupFactory;
    protected $attributeSetFactory;

    /**
     * DataCustomerAttribute constructor.
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory
     * @param AttributeSetFactory $attributeSetFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory,
        AttributeSetFactory $attributeSetFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->customerSetupFactory = $customerSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $setup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $customerEntity = $setup->getEavConfig()->getEntityType('customer');
        $attributeSetId = $customerEntity->getDefaultAttributeSetId();
        $attributeSet = $this->attributeSetFactory->create();
        $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);
        $setup->addAttribute(
            Customer::ENTITY, 'customer_avatar', [
            'type' => 'text',
            'label' => 'Custom Image Uploader',
            'input' => 'image',
            'default' => '0',
            'user_defined' => true,
            'sort_order' => 210,
            'visible' => true,
            'required' => false,
            'source' => '',
            'position' => 200,
            'system' => 0
        ]);
        $avatarAttribute = $setup->getEavConfig()->getAttribute('customer', 'customer_avatar')->addData(
                [
                    'attribute_set_id' => $attributeSetId,
                    'attribute_group_id' => $attributeGroupId,
                    'used_in_forms' => ['adminhtml_customer', 'customer_account_create', 'customer_account_edit'],
                ]);
        $avatarAttribute->save();
        $this->moduleDataSetup->getConnection()->endSetup();
    }
}