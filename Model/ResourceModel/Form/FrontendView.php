<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Model\ResourceModel\Form;

class FrontendView extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct() // @codingStandardsIgnoreLine
    {
        $this->_init('alekseon_custom_form_frontend_view', 'entity_id');
    }
}
