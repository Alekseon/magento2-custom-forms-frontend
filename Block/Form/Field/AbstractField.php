<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Form\Field;

use Alekseon\AlekseonEav\Model\Attribute\InputValidator\AbstractValidator;
use Alekseon\CustomFormsBuilder\Model\FormRecord\Attribute;

/**
 * Class AbstractField
 * @package Alekseon\CustomFormsFrontend\Block\Form\Field
 */
class AbstractField extends \Magento\Framework\View\Element\Template implements InputBlockInterface
{
    /**
     * @var
     */
    private $dataValidateParams;
    /**
     * @var
     */
    private $validationClass;
    /**
     * @var bool
     */
    private $validatorsProcessed = false;

    /**
     * @return $this
     */
    public function prepare()
    {
        $this->processValidators();
        return $this;
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return (bool) $this->getData('is_required');
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->getData('label');
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->getData('name');
    }

    public function getId()
    {
        return $this->getData('id');
    }

    /**
     * @return true
     */
    public function displayLabel()
    {
        return $this->isVisible() && $this->getLabel();
    }

    /**
     * @return mixed
     */
    public function isVisible()
    {
        return true;
    }

    /**
     * @return Attribute
     */
    public function getField()
    {
        return $this->getData('field');
    }

    /**
     * @return $this
     */
    private function processValidators()
    {
        if (!$this->validatorsProcessed) {
            $this->validationClass = '';
            $this->dataValidateParams = [];
            if ($this->isRequired()) {
                $this->dataValidateParams['required'] = true;
            }
            $inputValidators = $this->getField()->getInputValidators();
            /** @var AbstractValidator $validator */
            foreach ($inputValidators as $validator) {
                $validateParams = $validator->getDataValidateParams();
                foreach ($validateParams as $key => $value) {
                    $this->dataValidateParams[$key] = $value;
                }

                $this->validationClass .= $validator->getValidationFieldClass();
                $this->_eventManager->dispatch(
                    'alekseon_custom_form_after_add_field_validator_' . $validator->getCode(),
                    [
                        'validator' => $validator,
                        'field_block' => $this,
                    ]
                );
            }
            $this->validatorsProcessed = true;
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getDataValidateParams()
    {
        $this->processValidators();
        return $this->dataValidateParams;
    }

    /**
     * @return mixed
     */
    public function getValidationClass()
    {
        $this->processValidators();
        return $this->validationClass;
    }

    /**
     * @return string
     */
    public function getContainerClass()
    {
        $container = $this->getField()->getAttributeExtraParam('frontend_input_block');
        if (!$container || $container == 'default') {
            $container = $this->getField()->getFrontendInput();
        }
        $containerClass = $container . '-container';
        if ($this->getField()->getIdentifier()) {
            $containerClass .= ' ' . $this->getField()->getIdentifier() . '-field-container';
        }
        return $containerClass;
    }

    /**
     * @return string
     */
    public function getFieldClass()
    {
        return $this->isRequired() ? 'required' : '';
    }

    /**
     *
     */
    public function getDataValidateJson()
    {
       $dataValidate = $this->getDataValidateParams();
       return json_encode($dataValidate);
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
       return $this->getField()->getNote();
    }

    /**
     *
     */
    public function getPlaceholder()
    {
        return '';
    }

    /**
     *
     */
    public function getDefaultValue()
    {
        return $this->getField()->getDefaultValue();
    }


    /**
     * @return string[]
     */
    public function getLabelAllowedTags()
    {
        return ['a'];
    }
}
