<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Form\Field;

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
     * @return array
     */
    public function getDataValidateParams()
    {
        if ($this->dataValidateParams === null) {
            $this->validationClass = '';
            $this->dataValidateParams = [];
            if ($this->isRequired()) {
                $this->dataValidateParams['required'] = true;
            }

            $inputValidators = $this->getField()->getInputValidators();
            foreach ($inputValidators as $validator) {
                $validateParams = $validator->getDataValidateParams();
                foreach ($validateParams as $key => $value) {
                    $this->dataValidateParams[$key] = $value;
                }

                $this->validationClass .= $validator->getValidationFieldClass();
            }
        }

        return $this->dataValidateParams;
    }

    /**
     * @return mixed
     */
    public function getValidationClass()
    {
        $this->getDataValidateParams();
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
        return $this->isRequired() ? 'required' : 'aaa';
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
