<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Form;

use Alekseon\AlekseonEav\Api\Data\AttributeInterface;
use Alekseon\CustomFormsBuilder\Model\FormRecord\Attribute;
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
     * @return void
     */
    private function addInputBlock()
    {
        $attribute = $this->getFormAttribute();
        if (!$attribute instanceof AttributeInterface) {
            return;
        }
        if ($attribute->getInputVisibility() != Attribute::INPUT_VISIBILITY_VISIBILE) {
            return;
        }

        $frontendInputTypeConfig = $attribute->getFrontendInputTypeConfig();
        if (!$frontendInputTypeConfig) {
            return;
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
            $frontendBlock['id'] = $attribute->getAttributeCode();;
            $frontendBlock['label'] = $attribute->getFrontendLabel();
            $frontendBlock['name'] = $attribute->getAttributeCode();

            /** @var AbstractField $inputBlock */
            $inputBlock = $this->addChild(
                'field_input',
                $class,
                $frontendBlock
            );

            $inputBlock->prepare();
            $this->setData('input_block', $inputBlock);
        }
    }

    /**
     * @return AbstractField|null
     */
    public function getInputBlock()
    {
        return $this->getData('input_block');
    }

    /**
     * @inheritDoc
     */
    protected function _prepareLayout()
    {
        $this->addInputBlock();
        return parent::_prepareLayout();
    }
}
