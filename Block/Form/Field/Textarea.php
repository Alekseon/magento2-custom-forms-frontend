<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Form\Field;

/**
 * Class Textarea
 * @package Alekseon\CustomFormsFrontend\Block\Form\Field
 */
class Textarea extends \Alekseon\CustomFormsFrontend\Block\Form\Field\AbstractField
{
    protected $_template = "Alekseon_CustomFormsFrontend::form/field/textarea.phtml";

    /**
     *
     */
    public function getMaxLength()
    {
        return $this->getField()->getInputParam('maxLength');
    }
}
