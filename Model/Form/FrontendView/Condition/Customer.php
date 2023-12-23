<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Model\Form\FrontendView\Condition;

use Magento\Rule\Model\Condition\Context;

class Customer extends AbstractCondition
{
    /**
     * @var \Magento\Config\Model\Config\Source\Yesno
     */
    private $yesNoOptions;

    /**
     * @param Context $context
     * @param \Magento\Config\Model\Config\Source\Yesno $yesNo
     * @param array $data
     */
    public function __construct(
        \Magento\Rule\Model\Condition\Context $context,
        \Magento\Config\Model\Config\Source\Yesno $yesNo,
        array $data = []
    )
    {
        $this->yesNoOptions = $yesNo;
        parent::__construct($context, $data);
    }

    public function getLabel()
    {
        return __('Customer');
    }

    public function loadAttributeOptions()
    {
        $attributes = [
            'customer_email' => __('Customer Email'),
            'customer_group' => __('Customer Group'),
            'is_logged_in' => __('Customer Logged In'),
        ];

        $this->setAttributeOption($attributes);

        return $this;
    }

    public function getInputType()
    {
        switch ($this->getAttribute()) {
            case 'customer_email':
            case 'customer_group':
            case 'is_logged_in':
                return 'select';
        }
        return 'text';
    }

    public function getValueElementType()
    {
        switch ($this->getAttribute()) {
            case 'customer_email':
            case 'customer_group':
            case 'is_logged_in':
                return 'select';
        }
        return 'text';
    }

    public function getValueSelectOptions()
    {
        if (!$this->hasData('value_select_options')) {
            switch ($this->getAttribute()) {
                case 'customer_email':
                    $options = [['value' => '1', 'label' => 'aaa']];
                    break;
                case 'is_logged_in':
                    $options = $this->yesNoOptions->toOptionArray();
                    break;
                default:
                    $options = [];
            }
            $this->setData('value_select_options', $options);
        }
        return $this->getData('value_select_options');
    }

    public function getAttributeElement()
    {
        $element = parent::getAttributeElement();
        $element->setShowAsText(true);
        return $element;
    }
}
