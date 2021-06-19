<?php

namespace Alliance\Linkedin\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Setup\CustomerSetupFactory;

class InstallData implements InstallDataInterface {

    public function __construct(
        CustomerSetupFactory $customerSetupFactory
    )
    {
        $this->customerSetupFactory = $customerSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->addLinkedinAttribute($setup);
    }

    protected function addLinkedinAttribute(ModuleDataSetupInterface $setup) {
        $customerSetup = $this->customerSetupFactory->create(['setup'=>$setup]);

        if(!$customerSetup->getAttributeId('customer_address','linkedin')) {
            $customerSetup->addAttribute('customer_address','linkedin',[
                    'type'=>'varchar',
                    'label'=>'Linkedin',
                    'visible'=> true,
                    'system'=>0,
                    'visible_on_front'=>false
                ]
            );
        }
    }
}
