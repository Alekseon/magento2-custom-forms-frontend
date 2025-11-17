<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Form\Field;

/**
 * Class Hidden
 * @package Alekseon\CustomFormsFrontend\Block\Form\Field
 */
class Hidden extends \Alekseon\CustomFormsFrontend\Block\Form\Field\Text
{
    /**
     * @return bool
     */
    public function isVisible()
    {
        return false;
    }
}
