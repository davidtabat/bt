<?php
namespace Alliance\Linkedin\Plugin\Block\Checkout;

class LayoutProcessor {
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        $jsLayout
    ) {

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
            ['shippingAddress']['children']['shipping-address-fieldset']['children']['linkedin'] =
            $this->processLinkedin('shippingAddress');
        return $jsLayout;
    }

    private function processLinkedin($dataScopePrefix){
        return [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => $dataScopePrefix.'.custom_attributes',
                'customEntry'=> null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/input',
                'options' => [],
                'id' => 'linkedin'
            ],
            'dataScope' => 'shippingAddress.custom_attributes.linkedin',
            'label' => 'Linkedin',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [],
            'sortOrder' => 299
        ];
    }
}
