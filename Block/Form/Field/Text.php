<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Form\Field;

use Alekseon\AlekseonEav\Model\Attribute\InputType\AbstractInputType;

/**
 * Class Text
 * @package Alekseon\CustomFormsFrontend\Block\Form\Field
 */
class Text extends \Alekseon\CustomFormsFrontend\Block\Form\Field\AbstractField
{
    protected $_template = "Alekseon_CustomFormsFrontend::form/field/text.phtml";

    /**
     * @return bool
     */
    public function isVisible()
    {
        /** @var AbstractInputType $field */
        $field = $this->getField();

        if ($field->getFrontendInput() == 'hidden') {
            return false;
        }

        return parent::isVisible();
    }
}
