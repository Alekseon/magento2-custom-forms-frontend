<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\CustomFormsFrontend\Block\Form\Field;

use Alekseon\CustomFormsFrontend\Model\Attribute\InputType\CmsBlock as CmsBlockInputType;

class CmsBlock extends \Alekseon\CustomFormsFrontend\Block\Form\Field\AbstractField
{
    protected $_template = "Alekseon_CustomFormsFrontend::form/field/cms_block.phtml";

    /**
     * @return string
     */
    public function getCmsBlockIdentifier(): string
    {
        return (string) $this->getField()->getInputParam(CmsBlockInputType::CMS_BLOCK_INPUT_PARAM);
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        $identifier = $this->getCmsBlockIdentifier();
        if (!$identifier) {
            return '';
        }

        return (string) $this->getLayout()
            ->createBlock(\Magento\Cms\Block\Block::class)
            ->setBlockId($identifier)
            ->toHtml();
    }
}
