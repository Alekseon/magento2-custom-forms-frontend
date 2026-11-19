<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Form\Field;

use Alekseon\CustomFormsFrontend\Model\Attribute\InputType\ContentBlock as ContentBlockInputType;

/**
 * Renders static content (heading / text) between form fields.
 */
class ContentBlock extends AbstractField
{
    /**
     * @return bool
     */
    public function isRequired()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function displayLabel()
    {
        return false;
    }

    /**
     * @return string
     */
    public function getFieldClass()
    {
        return 'form-content-block';
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return (string) $this->getField()->getInputParam(ContentBlockInputType::CONTENT_PARAM);
    }
}
