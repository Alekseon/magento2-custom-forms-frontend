<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Model\FrontendView;

use Alekseon\CustomFormsFrontend\Model\FrontendView\AttributeFactory;

/**
 * Class AttributeRepository
 * @package Alekseon\CustomFormsBuilder\Model\FormRecord
 */
class AttributeRepository extends \Alekseon\AlekseonEav\Model\AttributeRepository
{
    /**
     * @var AttributeFactory
     */
    protected $attributeFactory;

    /**
     * AttributeRepository constructor.
     * @param AttributeFactory $attributeFactory
     */
    public function __construct(
        \Alekseon\CustomFormsFrontend\Model\FrontendView\AttributeFactory $attributeFactory
    ) {
        $this->attributeFactory = $attributeFactory;
    }

    /**
     * @return AttributeFactory
     */
    public function getAttributeFactory()
    {
        return $this->attributeFactory;
    }
}
