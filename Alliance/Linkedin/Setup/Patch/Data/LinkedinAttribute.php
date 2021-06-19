<?php

namespace Alliance\Linkedin\Setup\Patch\Data;

use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Setup\Patch\Data\UpdateIdentifierCustomerAttributesVisibility;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Customer\Model\ResourceModel\Attribute;

/**
 * Class AddCustomerCertificationAttribute
 * @package Techflarestudio\Content\Setup\Patch\Data
 */
class LinkedinAttribute implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * @var Attribute
     */
    private $attributeResource;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CustomerSetupFactory $customerSetupFactory
     * @param Attribute $attributeResource
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CustomerSetupFactory $customerSetupFactory,
        Attribute $attributeResource
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->customerSetupFactory = $customerSetupFactory;
        $this->attributeResource = $attributeResource;
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);

        /**
         * Add attribute
         */
        $customerSetup->addAttribute(
            Customer::ENTITY,
            'linkedin_profile',
            [
                'type' => 'text',
                'label' => 'Linkedin',
                'input' => 'text',
                'backend' => '',
                'position' => 100,
                'required' => false,
                'system' => false,
                'visible' => true,
            ]
        );

        /**
         * Fetch the newly created attribute and set options to be used in forms
         */
        $certificationAttribute = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'linkedin_profile');

        $certificationAttribute->setData('used_in_forms', [
            'adminhtml_customer',
            'adminhtml_sales_order_create_index',
            'adminhtml_checkout',
            'checkout_register',
            'adminhtml_customer_address',
            'customer_account_edit',
            'customer_address_edit',
            'customer_register_address',
            'customer_address',
            'customer_account_create',
        ]);

        $this->attributeResource->save($certificationAttribute);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [
            UpdateIdentifierCustomerAttributesVisibility::class,
        ];
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }
}
