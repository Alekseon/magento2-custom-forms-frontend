<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Model\Form\FrontendView\Condition;

abstract class AbstractCondition  extends \Magento\Rule\Model\Condition\AbstractCondition
{
    protected $elementName = 'frontend_view_conditions';
}
