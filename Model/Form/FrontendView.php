<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Model\Form;

use Alekseon\CustomFormsBuilder\Model\Form\ResourceModel;

class FrontendView extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @param \Alekseon\AlekseonEav\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ResourceModel\FrontendView $resource
     * @param ResourceModel\FrontendView\Collection $resourceCollection
     */
    public function __construct(
        \Alekseon\AlekseonEav\Model\Context                                            $context,
        \Magento\Framework\Registry                                                    $registry,
        \Alekseon\CustomFormsFrontend\Model\ResourceModel\Form\FrontendView            $resource,
        \Alekseon\CustomFormsFrontend\Model\ResourceModel\Form\FrontendView\Collection $resourceCollection
    ) {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection
        );
    }
}
