<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Observer;

use Alekseon\CustomFormsFrontend\Model\Attribute\InputType\ContentBlock;
use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Content block (heading / text) has no own label in admin, it is generated from its content.
 */
class SetContentBlockLabel implements ObserverInterface
{
    private const LABEL_MAX_LENGTH = 60;

    /**
     * @var BlockRepositoryInterface
     */
    private $blockRepository;

    /**
     * @param BlockRepositoryInterface $blockRepository
     */
    public function __construct(BlockRepositoryInterface $blockRepository)
    {
        $this->blockRepository = $blockRepository;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $attribute = $observer->getEvent()->getAttribute();
        if (!ContentBlock::isContentBlock($attribute->getFrontendInput())) {
            return;
        }

        if ($attribute->getFrontendInput() === ContentBlock::CMS_BLOCK_CODE) {
            $content = $this->getCmsBlockTitle((int) $attribute->getInputParam(ContentBlock::CMS_BLOCK_PARAM));
        } else {
            $content = (string) $attribute->getInputParam(ContentBlock::CONTENT_PARAM);
        }
        $label = trim((string) preg_replace('/\s+/u', ' ', strip_tags($content)));
        if (mb_strlen($label) > self::LABEL_MAX_LENGTH) {
            $label = mb_substr($label, 0, self::LABEL_MAX_LENGTH - 3) . '...';
        }

        $attribute->setFrontendLabel($label !== '' ? $label : $attribute->getFrontendInput());
    }

    /**
     * @param int $blockId
     * @return string
     */
    private function getCmsBlockTitle(int $blockId): string
    {
        if (!$blockId) {
            return '';
        }
        try {
            return (string) $this->blockRepository->getById($blockId)->getTitle();
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            return '';
        }
    }
}
