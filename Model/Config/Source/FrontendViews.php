<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Model\Config\Source;

/**
 *
 */
class FrontendViews implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var
     */
    private $options;
    /**
     * @var \Alekseon\CustomFormsFrontend\Model\ResourceModel\Form\FrontendView\CollectionFactory
     */
    private $frontendViewCollectionFactory;

    /**
     * @param \Alekseon\CustomFormsFrontend\Model\ResourceModel\Form\FrontendView\CollectionFactory $frontendViewCollectionFactory
     */
    public function __construct(
        \Alekseon\CustomFormsFrontend\Model\ResourceModel\Form\FrontendView\CollectionFactory $frontendViewCollectionFactory
    )
    {
        $this->frontendViewCollectionFactory = $frontendViewCollectionFactory;
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function toOptionArray()
    {
        $optionArray = [];
        $options = $this->toArray();
        foreach ($options as $optionId => $optionLabel)
        {
            $optionArray[$optionId] = $optionLabel;
        }
        return $optionArray;
    }

    /**
     * @return array|null
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function toArray()
    {
        if ($this->options === null) {
            $this->options = [];
            $formCollection = $this->frontendViewCollectionFactory->create();
            foreach ($formCollection as $form) {
                $this->options[$form->getId()] = $form->getTitle();
            }
        }
        return $this->options;
    }
}
