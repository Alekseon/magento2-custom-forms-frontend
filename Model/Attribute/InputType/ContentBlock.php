<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Model\Attribute\InputType;

use Alekseon\AlekseonEav\Model\Attribute\InputType\AbstractInputType;

/**
 * Static content (heading / text / cms block) placed between form fields.
 * It does not collect any value from the customer.
 */
class ContentBlock extends AbstractInputType
{
    public const HEADING_CODE = 'content_heading';
    public const TEXT_CODE = 'content_text';
    public const CMS_BLOCK_CODE = 'content_cms_block';
    public const CONTENT_PARAM = 'content';
    public const CMS_BLOCK_PARAM = 'cms_block_id';

    /**
     * @param string|null $frontendInput
     * @return bool
     */
    public static function isContentBlock(?string $frontendInput): bool
    {
        return in_array($frontendInput, [self::HEADING_CODE, self::TEXT_CODE, self::CMS_BLOCK_CODE], true);
    }

    /**
     * @var string
     */
    protected $inputFieldType = 'note';
    /**
     * @var bool
     */
    protected $canDisplayInGrid = false;

    /**
     * @param array $fieldConfig
     * @return $this
     */
    public function prepareFormFieldConfig(&$fieldConfig)
    {
        $content = (string) $this->getAttribute()->getInputParam(self::CONTENT_PARAM);
        $fieldConfig['text'] = nl2br(htmlspecialchars($content, ENT_QUOTES));
        unset($fieldConfig['required']);
        return $this;
    }

    /**
     * @return null
     */
    public function getDefaultValue()
    {
        return null;
    }
}
