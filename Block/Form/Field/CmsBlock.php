<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Form\Field;

use Alekseon\CustomFormsFrontend\Model\Attribute\InputType\ContentBlock as ContentBlockInputType;

/**
 * Renders CMS block between form fields.
 */
class CmsBlock extends ContentBlock
{
    /**
     * Native CMS block renderer: content filter, current store, only active block
     *
     * @return string
     */
    public function getCmsBlockHtml(): string
    {
        $blockId = (int) $this->getField()->getInputParam(ContentBlockInputType::CMS_BLOCK_PARAM);
        if (!$blockId) {
            return '';
        }

        return (string) $this->getLayout()
            ->createBlock(\Magento\Cms\Block\Block::class)
            ->setBlockId($blockId)
            ->toHtml();
    }
}
