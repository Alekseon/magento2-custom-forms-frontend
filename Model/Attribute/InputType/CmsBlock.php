<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Model\Attribute\InputType;

use Magento\Cms\Model\Block;
use Magento\Framework\DataObject\IdentityInterface;

/**
 * CMS block placed between form fields.
 */
class CmsBlock extends ContentBlock implements IdentityInterface
{
    /**
     * In admin (form record view) CMS block is presented by its title (field label)
     *
     * @param array $fieldConfig
     * @return $this
     */
    public function prepareFormFieldConfig(&$fieldConfig)
    {
        $fieldConfig['text'] = htmlspecialchars($this->getAttribute()->getDefaultFrontendLabel(), ENT_QUOTES);
        unset($fieldConfig['required']);
        return $this;
    }

    /**
     * Cache tags of used CMS block, so cached form is refreshed when CMS block is changed
     *
     * @return string[]
     */
    public function getIdentities()
    {
        $blockId = (int) $this->getAttribute()->getInputParam(self::CMS_BLOCK_PARAM);
        return $blockId ? [Block::CACHE_TAG . '_' . $blockId] : [];
    }
}
