<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Model\FrontendView\Condition;

use Alekseon\CustomFormsBuilder\Model\Form\Attribute;
use Magento\Rule\Model\Condition\Context;

class FormFields extends AbstractCondition
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @param Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param array $data
     */
    public function __construct(
        Context $context,
        \Magento\Framework\Registry $coreRegistry,
        array $data = []
    ) {
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
    }

    public function getLabel()
    {
        return __('Form Fields');
    }

    /**
     * @return $this|FormFields
     */
    public function loadAttributeOptions()
    {
        $attributes = [];
        $currentForm = $this->coreRegistry->registry('current_form');
        if ($currentForm) {
            $fieldsCollection = $currentForm->getFieldsCollection();
            /** @var Attribute $field */
            foreach ($fieldsCollection as $field) {
                $attributes[$field->getAttributeCode()] = $field->getDefaultFrontendLabel();
            }
        }

        $this->setAttributeOption($attributes);

        return $this;
    }
}
