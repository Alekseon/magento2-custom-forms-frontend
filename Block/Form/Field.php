<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Form;

/**
 *
 */
class Field extends \Magento\Framework\View\Element\Template
{
    protected $_template = "Alekseon_CustomFormsFrontend::form/field.phtml";

    /**
     * @return false|void
     */
    private function addFieldInput()
    {
        $attribute = $this->getAttribute();
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
            $frontendBlock['form'] = $attribute->getForm();
            $frontendBlock['is_required'] = $attribute->getIsRequired();

            $this->addChild(
                'field_input',
                $class,
                $frontendBlock
            );
        }
    }

    /**
     * @return string
     */
    protected function _toHtml()
    {
        $this->addFieldInput();
        return parent::_toHtml();
    }
}
