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
 * CMS blocks by identifier, block content is resolved by current store view on frontend
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
            $collection = $this->collectionFactory->create()->setOrder('identifier', 'ASC');
            $added = [];
            foreach ($collection as $block) {
                $identifier = (string) $block->getIdentifier();
                if ($identifier === '' || isset($added[$identifier])) {
                    continue;
                }
                $added[$identifier] = true;
                $this->options[] = [
                    'value' => $identifier,
                    'label' => $identifier . ' (' . $block->getTitle() . ')',
                ];
            }
        }
        return $this->options;
    }
}
