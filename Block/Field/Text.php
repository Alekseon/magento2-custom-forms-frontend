<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\CustomFormsFrontend\Block\Field;

/**
 * Class Text
 * @package Alekseon\CustomFormsFrontend\Block\Field
 */
class Text extends \Magento\Backend\Block\Template
{
    /**
     * @var string
     */
    protected $_template = 'Alekseon_CustomFormsFrontend::field/text.phtml';

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->getFormRecord()->getData($this->getRecordAttribute()->getAttributeCode());
    }
}

