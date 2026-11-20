<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\CustomFormsFrontend\Observer;

use Alekseon\CustomFormsFrontend\Block\Form\Field\AbstractField;
use Magento\Eav\Model\Form\Fieldset;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\View\Element\Template;

class FieldsetModifier implements ObserverInterface
{
    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        $fieldsetType = $observer->getEvent()->getFieldsetType();
        $formFieldId = $observer->getEvent()->getFormFieldId();
        $settings = $observer->getEvent()->getFieldSettingObject()->getSettings();
        /** @var Fieldset $fieldset */
        $fieldset = $observer->getEvent()->getFieldset();

        if (in_array($fieldsetType, ['static_content', 'static_heading', 'cms_block'], true)) {
            $fieldset->removeField('form_field_' . $formFieldId . '_is_required');
            $fieldset->removeField('form_field_' . $formFieldId . '_frontend_label');
            $frontendInputType = $settings['frontend_input_type'] ?? '';
            if ($frontendInputType) {
                $settings['input_params'] = $frontendInputType['input_params'] ?? [];
            }
            $observer->getEvent()->getFieldSettingObject()->setSettings($settings);
        }
    }
}
