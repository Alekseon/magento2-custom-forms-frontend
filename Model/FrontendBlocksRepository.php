<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Model;

use Alekseon\CustomFormsBuilder\Model\FormRecord;

/**
 * Class FrontendBlocksRepository
 * @package Alekseon\CustomFormsFrontend\Model
 */
class FrontendBlocksRepository
{
    /**
     * @var array
     */
    protected $frontendBlocks;

    /**
     * FrontendBlocksRepository constructor.
     * @param array $frontendBlocks
     */
    public function __construct(
        array $frontendBlocks = []
    ) {
        $this->frontendBlocks = $frontendBlocks;
    }

    /**
     * @param FormRecord\Attribute $attribute
     */
    public function getFrontendBlock(FormRecord\Attribute $attribute)
    {
        $frontendInput = $attribute->getFrontendInput();

        if (isset($this->frontendBlocks[$frontendInput])) {
            return $this->frontendBlocks[$frontendInput];
        }

        return false;
    }
}
