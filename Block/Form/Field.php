<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Form;

use Alekseon\AlekseonEav\Api\Data\AttributeInterface;
use Alekseon\AlekseonEav\Model\AttributeRepository;
use Alekseon\CustomFormsFrontend\Block\Form\Field\AbstractField;
use Magento\Framework\View\Element\AbstractBlock;

/**
 *
 */
class Field extends \Magento\Framework\View\Element\Template
{
    protected $_template = "Alekseon_CustomFormsFrontend::form/field.phtml";

    /**
     * @param AttributeInterface $attribute
     * @return Field
     */
    public function setFormAttribute(AttributeInterface $attribute)
    {
        return $this->setData('attribute', $attribute);
    }

    /**
     * @return AttributeInterface
     */
    public function getFormAttribute()
    {
        return $this->getData('attribute');
    }

    /**
     * @return AbstractBlock|false
     */
    private function addInputBlock()
    {
        $attribute = $this->getFormAttribute();
        if (!$attribute instanceof AttributeInterface) {
            return false;
        }

        $frontendInputTypeConfig = $attribute->getFrontendInputTypeConfig();
        if (!$frontendInputTypeConfig) {
            return false;
        }
        $frontendBlocks = $frontendInputTypeConfig->getFrontendBlocks();
        $frontendBlock = [];
        $frontendInputBlock = $attribute->getAttributeExtraParam('frontend_input_block');

        if (isset($frontendBlocks['default'])) {
            $frontendBlock = $frontendBlocks['default'];
        }

        if (isset($frontendBlocks[$frontendInputBlock])) {
            $frontendBlock = array_merge($frontendBlock, $frontendBlocks[$frontendInputBlock]);
        }

        if (isset($frontendBlock['class'])) {
            $class = $frontendBlock['class'];
            unset($frontendBlock['class']);
            $frontendBlock['field'] = $attribute;
            $frontendBlock['is_required'] = $attribute->getIsRequired();
            $frontendBlock['id'] = $this->getFieldId();
            $frontendBlock['label'] = $attribute->getFrontendLabel();
            $frontendBlock['name'] = $attribute->getAttributeCode();

            return $this->addChild(
                'field_input',
                $class,
                $frontendBlock
            );
        }

        return false;
    }

    /**
     * @return string
     */
    public function getFieldId()
    {
        $fieldId = $this->getData('field_id');
        if ($fieldId === null) {
            $attribute = $this->getAttribute();
            $fieldId = 'form_field_';
            if ($attribute->getForm()) {
                $fieldId .= $attribute->getForm()->getId();
            }
            $fieldId .= '_' . $attribute->getAttributeCode();
            $this->setData('field_id', $fieldId);
        }
        return $fieldId;
    }

    /**
     * @return AbstractField|null
     */
    public function getInputBlock()
    {
        return $this->getData('input_block');
    }

    /**
     * @return string
     */
    protected function _toHtml()
    {
        $inputBlock = $this->addInputBlock();
        if ($inputBlock) {
            $this->setData('input_block', $inputBlock);
        }
        return parent::_toHtml();
    }
}
