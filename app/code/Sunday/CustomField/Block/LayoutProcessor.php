<?php
/**
 * Sunday - Checkout Custom Field
 *
 * @category Sunday
 * @package  Sunday/CustomField
 * @author   Ali Us. <mealyus@gmail.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://github.com/mealyus/
 */

namespace Sunday\CustomField\Block;

class LayoutProcessor implements \Magento\Checkout\Block\Checkout\LayoutProcessorInterface
{
    /**
     * Add custom field to checkout layout
     *
     * @param array $jsLayout
     * @return array
     */
    public function process($jsLayout)
    {
        $attributeCode = 'delivery_note';
        $fieldConfiguration = [
            'component' => 'Magento_Ui/js/form/element/textarea',
            'config' => [
                'customScope' => 'shippingAddress.extension_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/textarea',
                'tooltip' => [
                    'description' => 'Here you can leave Order Notes',
                ],
            ],
            'dataScope' => 'shippingAddress.extension_attributes' . '.' . $attributeCode,
            'label' => 'Order Comments',
            'provider' => 'checkoutProvider',
            'sortOrder' => 1000,
            'validation' => [
                'required-entry' => true
            ],
            'options' => [],
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true,
            'value' => ''
        ];

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']
        ['children']['shippingAddress']['children']['shipping-address-fieldset']
        ['children'][$attributeCode] = $fieldConfiguration;
        return $jsLayout;
    }
}
