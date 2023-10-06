<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Form\Field;

interface InputBlockInterface
{
    /**
     * @return mixed
     */
    public function isRequired();

    /**
     * @return mixed
     */
    public function getLabel();

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @return mixed
     */
    public function displayLabel();

    /**
     * @return mixed
     */
    public function isVisible();

    /**
     * @return mixed
     */
    public function getNote();

    /**
     * @return mixed
     */
    public function getDefaultValue();

    /**
     * @return mixed
     */
    public function getLabelAllowedTags();
}
