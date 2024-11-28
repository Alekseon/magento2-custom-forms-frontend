<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Field;

class Date extends \Alekseon\CustomFormsFrontend\Block\Field\Text
{
    /**
     * @inheritDoc
     */
    public function getValue()
    {
        try {
            return $this->formatDate(parent::getValue(), \IntlDateFormatter::MEDIUM);
        } catch (\Exception $e) {
            return '';
        }
    }
}
