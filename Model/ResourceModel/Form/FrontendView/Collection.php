<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Model\ResourceModel\Form\FrontendView;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct() // @codingStandardsIgnoreLine
    {
        $this->_init(
            'Alekseon\CustomFormsFrontend\Model\Form\FrontendView',
            'Alekseon\CustomFormsFrontend\Model\ResourceModel\Form\FrontendView'
        );
    }
}
