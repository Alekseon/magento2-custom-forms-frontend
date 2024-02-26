<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Model\FrontendView\Condition;

abstract class AbstractCondition  extends \Magento\Rule\Model\Condition\AbstractCondition
{
    protected $elementName = 'conditions';

    public function getAttributeElement()
    {
        $element = parent::getAttributeElement();
        $element->setShowAsText(true);
        return $element;
    }
}
