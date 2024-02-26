<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Model\ResourceModel\FrontendView\Attribute;

/**
 * Class Collection
 * @package Alekseon\CustomFormsFrontend\Model\ResourceModel\FrontendView\Attribute
 */
class Collection extends \Alekseon\AlekseonEav\Model\ResourceModel\Attribute\Collection
{
    /**
     * @return void
     */
    protected function _construct() // @codingStandardsIgnoreLine
    {
        $this->_init(
            'Alekseon\CustomFormsFrontend\Model\FrontendView\Attribute',
            'Alekseon\CustomFormsFrontend\Model\ResourceModel\FrontendView\Attribute'
        );
    }
}
