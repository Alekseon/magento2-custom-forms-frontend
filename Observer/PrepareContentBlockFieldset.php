<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Observer;

use Alekseon\CustomFormsFrontend\Model\Attribute\InputType\ContentBlock;
use Magento\Framework\Data\Form\Element\Fieldset;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Removes settings which make no sense for static content (heading / text) fields.
 */
class PrepareContentBlockFieldset implements ObserverInterface
{
    public const CONTENT_BLOCK_FLAG = 'is_content_block';

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $formFieldId = (string) $observer->getEvent()->getFormFieldId();
        /** @var Fieldset $fieldset */
        $fieldset = $observer->getEvent()->getFieldset();
        $fieldSettings = $observer->getEvent()->getFieldSettings();

        $attribute = $fieldSettings['attribute'] ?? null;
        $frontendInput = $attribute ? $attribute->getFrontendInput() : ($fieldSettings['frontend_input'] ?? null);
        if (!ContentBlock::isContentBlock($frontendInput)) {
            return;
        }

        // used by ContentBlockFieldsOrderPlugin
        $fieldset->setData(self::CONTENT_BLOCK_FLAG, true);

        $prefix = 'form_field_' . $formFieldId . '_';
        $fieldset->removeField($prefix . 'is_required');
        $fieldset->removeField($prefix . 'input_visibility');
        // label is generated from content (see SetContentBlockLabel observer)
        $fieldset->removeField($prefix . 'frontend_label');

        if (!$attribute) {
            // new field is created only if it has a label, real one is set from content before save
            $fieldset->addField($prefix . 'frontend_label', 'hidden',
                [
                    'name' => 'form_fields[' . $formFieldId . '][frontend_label]',
                    'value' => $frontendInput,
                ]
            )->addCustomAttribute('data-fieldcode', 'frontend_label');
        }
    }
}
