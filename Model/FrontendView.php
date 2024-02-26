<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Model;

use Magento\Framework\DataObject\IdentityInterface;

/**
 * Class FrontendView
 * @package Alekseon\CustomFormsFrontend\Model
 */
class FrontendView extends \Alekseon\AlekseonEav\Model\Entity implements IdentityInterface
{
    /**
     * @param \Alekseon\AlekseonEav\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ResourceModel\FrontendView $resource
     * @param ResourceModel\FrontendView\Collection $resourceCollection
     */
    public function __construct(
        \Alekseon\AlekseonEav\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Alekseon\CustomFormsFrontend\Model\ResourceModel\FrontendView $resource,
        \Alekseon\CustomFormsFrontend\Model\ResourceModel\FrontendView\Collection $resourceCollection,
    ) {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection
        );
    }

    /**
     * @return string[]
     */
    public function getIdentities(): array
    {
        return [];
    }
}
