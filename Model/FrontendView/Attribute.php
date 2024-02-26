<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Model\FrontendView;

class Attribute extends \Alekseon\AlekseonEav\Model\Attribute
{
    /**
     * Attribute constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Alekseon\AlekseonEav\Model\Attribute\InputTypeRepository $inputTypeRepository
     * @param \Alekseon\AlekseonEav\Model\Attribute\InputValidatorRepository $inputValidatorRepository
     * @param \Alekseon\CustomFormsFrontend\Model\ResourceModel\FrontendView\Attribute $resource
     * @param \Alekseon\CustomFormsFrontend\Model\ResourceModel\FrontendView\Attribute\Collection $resourceCollection
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Alekseon\AlekseonEav\Model\Attribute\InputTypeRepository $inputTypeRepository,
        \Alekseon\AlekseonEav\Model\Attribute\InputValidatorRepository $inputValidatorRepository,
        \Alekseon\CustomFormsFrontend\Model\ResourceModel\FrontendView\Attribute $resource,
        \Alekseon\CustomFormsFrontend\Model\ResourceModel\FrontendView\Attribute\Collection $resourceCollection
    ) {
        parent::__construct(
            $context, $registry, $inputTypeRepository, $inputValidatorRepository, $resource, $resourceCollection
        );
    }
}
