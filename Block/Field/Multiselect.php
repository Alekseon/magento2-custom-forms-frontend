<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\CustomFormsFrontend\Block\Field;

/**
 * Class Multiselect
 * @package Alekseon\CustomFormsFrontend\Block\Field
 */
class Multiselect extends \Alekseon\CustomFormsFrontend\Block\Field\Select
{
    /**
     * @return mixed
     */
    public function getValue()
    {
        $value = explode(',', Text::getValue());
        $options = $this->getOptions();
        $valueLabels = [];
        foreach ($value as $optionId) {
            if (isset($options[$optionId])) {
                $valueLabels[] = $options[$optionId];
            }
        }

        return implode(', ', $valueLabels);
    }
}

