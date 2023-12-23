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
    private $conditions;

    /**
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Rule\Model\Condition\Context $context,
        $conditions = [],
        array $data = []
    )
    {
        $this->conditions = $conditions;
        parent::__construct($context, $data);
    }

    public function getNewChildSelectOptions()
    {
        $attributeConditions = [];
        foreach ($this->conditions as $condition) {
            $attributes = $condition->loadAttributeOptions()->getAttributeOption();
            $options = [];
            foreach ($attributes as $code => $label) {
                $options[] = [
                    'value' => get_class($condition) . '|' . $code,
                    'label' => $label,
                ];
            }
            $attributeConditions[] = ['label' => $condition->getLabel(), 'value' => $options];
        }

        $conditions = parent::getNewChildSelectOptions();
        $conditions = array_merge_recursive(
            $conditions,
            [
                [
                    'value' => \Alekseon\CustomFormsFrontend\Model\Form\FrontendView\Condition\Combine::class,
                    'label' => __('Conditions combination')
                ],
            ],
            $attributeConditions
        );
        return $conditions;
    }
}
