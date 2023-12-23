<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Model\Form\FrontendView\Condition;

use Magento\Rule\Model\Condition\Context;

/**
 *
 */
class Combine extends \Magento\Rule\Model\Condition\Combine
{
    protected $elementName = 'frontend_view_conditions';
    private $customerCondition;

    /**
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Rule\Model\Condition\Context $context,
        \Alekseon\CustomFormsFrontend\Model\Form\FrontendView\Condition\Customer $customerCondition,
        array $data = []
    )
    {
        $this->customerCondition = $customerCondition;
        parent::__construct($context, $data);
    }

    public function getNewChildSelectOptions()
    {
        $customerAttributes = $this->customerCondition->loadAttributeOptions()->getAttributeOption();

        $customerOptions = [];
        foreach ($customerAttributes as $code => $label) {
            $customerOptions[] = [
                'value' => $this->customerCondition::class . '|' . $code,
                'label' => $label,
            ];
        }

        $conditions = parent::getNewChildSelectOptions();
        $conditions = array_merge_recursive(
            $conditions,
            [
                [
                    'value' => \Alekseon\CustomFormsFrontend\Model\Form\FrontendView\Condition\Combine::class,
                    'label' => __('Conditions combination')
                ],
                ['label' => __('Customer'), 'value' => $customerOptions]
            ]
        );
        return $conditions;
    }
}
