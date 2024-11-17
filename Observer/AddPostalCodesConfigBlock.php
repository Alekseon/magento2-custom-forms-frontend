<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\CustomFormsFrontend\Observer;

use Alekseon\CustomFormsFrontend\Block\Form\Field\AbstractField;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\View\Element\Template;

class AddPostalCodesConfigBlock implements ObserverInterface
{
    /**
     * @var \Magento\Customer\Block\DataProviders\PostCodesPatternsAttributeData
     */
    private $postCodesPatternsAttributeData;
    /**
     * @var bool
     */
    private $hasPostalCodesConfigBlock = false;

    /**
     * @param \Magento\Customer\Block\DataProviders\PostCodesPatternsAttributeData $postCodesPatternsAttributeData
     */
    public function __construct(
        \Magento\Customer\Block\DataProviders\PostCodesPatternsAttributeData $postCodesPatternsAttributeData
    ) {
        $this->postCodesPatternsAttributeData = $postCodesPatternsAttributeData;
    }

    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        /** @var AbstractField $fieldBlock */
        $fieldBlock = $observer->getEvent()->getFieldBlock();
        if (!$this->hasPostalCodesConfigBlock) {
            $block = $fieldBlock->getParentBlock()->addChild('alekseon_postal_codes_config', Template::class, []);
            $block->setTemplate('Alekseon_CustomFormsFrontend::form/postal_codes.phtml');
            $block->setPostCodeConfig($this->postCodesPatternsAttributeData);
            $this->hasPostalCodesConfigBlock = true;
        }
    }
}
