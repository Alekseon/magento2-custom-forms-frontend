<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\CustomFormsFrontend\Model\Attribute\InputType;

class StaticText extends \Alekseon\AlekseonEav\Model\Attribute\InputType\AbstractInputType
{
    public const CONTENT_INPUT_PARAM = 'content';

    /**
     * @var string
     */
    protected $inputFieldType = 'note';
    /**
     * @var bool
     */
    protected $canDisplayInGrid = false;

    /**
     * @return bool
     */
    public function hasFrontendLabel()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function canBeRequired()
    {
        return false;
    }

    /**
     * @param $fieldConfig
     * @return StaticText
     */
    public function prepareFormFieldConfig(&$fieldConfig)
    {
        $fieldConfig['text'] = '';
        return parent::prepareFormFieldConfig($fieldConfig);
    }

    /**
     * @return true
     */
    public function getIsOnlyFrontendField()
    {
        return true;
    }
}
