<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\CustomFormsFrontend\Block\Form\Field;

use Alekseon\CustomFormsFrontend\Model\Attribute\InputType\StaticText as StaticTextInputType;

class StaticText extends \Alekseon\CustomFormsFrontend\Block\Form\Field\AbstractField
{
    protected $_template = "Alekseon_CustomFormsFrontend::form/field/static_text.phtml";

    /**
     * @return string
     */
    public function getContent(): string
    {
        return (string) $this->getField()->getInputParam(StaticTextInputType::CONTENT_INPUT_PARAM);
    }
}
