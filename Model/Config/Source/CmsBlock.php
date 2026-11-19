<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Model\Config\Source;

use Magento\Cms\Model\ResourceModel\Block\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * CMS blocks by ID (identifiers are not unique between store views)
 */
class CmsBlock implements OptionSourceInterface
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var array|null
     */
    private $options;

    /**
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        if ($this->options === null) {
            $this->options = [['value' => '', 'label' => __('-- Please Select --')]];
            $collection = $this->collectionFactory->create()->setOrder('title', 'ASC');
            foreach ($collection as $block) {
                $this->options[] = [
                    'value' => $block->getId(),
                    'label' => $block->getTitle() . ' (' . $block->getIdentifier() . ')',
                ];
            }
        }
        return $this->options;
    }
}
