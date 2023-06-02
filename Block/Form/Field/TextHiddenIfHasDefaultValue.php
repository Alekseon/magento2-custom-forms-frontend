<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Form\Field;

/**
 * Class TextHiddenIfHasDefaultValue
 * @package Alekseon\CustomFormsFrontend\Block\Form\Field
 */
class TextHiddenIfHasDefaultValue extends \Alekseon\CustomFormsFrontend\Block\Form\Field\Text
{
     /**
     * @return string
     */
    public function getTemplate()
    {
        if ($this->getField()->hasDefaultValue()) {
            return $this->getHiddenTemplate();
        } else {
            return parent::getTemplate();
        }
    }
}
