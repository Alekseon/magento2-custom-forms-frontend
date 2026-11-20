<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\CustomFormsFrontend\Model\Attribute\InputType;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Cms\Model\Block;

class CmsBlock extends StaticText implements IdentityInterface
{
    public const CMS_BLOCK_INPUT_PARAM = 'cms_block_id';

    /**
     * @inheritDoc
     */
    public function getIdentities()
    {
        $identifier = (string) $this->getAttribute()->getInputParam(self::CMS_BLOCK_INPUT_PARAM);
        return $identifier !== '' ? [Block::CACHE_TAG . '_' . $identifier] : [];
    }
}
