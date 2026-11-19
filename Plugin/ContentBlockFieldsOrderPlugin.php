<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Plugin;

use Alekseon\CustomFormsBuilder\Block\Adminhtml\Form\Edit\Tab\Fields\Form;
use Alekseon\CustomFormsFrontend\Observer\PrepareContentBlockFieldset;
use Magento\Framework\Data\Form as DataForm;
use Magento\Framework\Data\Form\Element\Fieldset;

/**
 * Content block fieldset order: input params (content, cms block), Sort Order.
 * Input params are added after "alekseon_custom_form_after_add_field_fieldset" event,
 * so Sort Order can be moved only when whole form is ready.
 */
class ContentBlockFieldsOrderPlugin
{
    /**
     * @param Form $subject
     * @param Form $result
     * @param DataForm $form
     * @return Form
     */
    public function afterSetForm(Form $subject, $result, DataForm $form)
    {
        foreach ($form->getElements() as $fieldset) {
            if (!$fieldset instanceof Fieldset || !$fieldset->getData(PrepareContentBlockFieldset::CONTENT_BLOCK_FLAG)) {
                continue;
            }

            $prefix = $fieldset->getId() . '_';
            $elements = $fieldset->getElements();
            $sortOrder = $elements->searchById($prefix . 'sort_order');
            $lastInputParamId = null;
            foreach ($elements as $element) {
                if (strpos((string) $element->getId(), $prefix . 'input_params_') === 0) {
                    $lastInputParamId = $element->getId();
                }
            }
            if ($sortOrder && $lastInputParamId) {
                $elements->remove($sortOrder->getId());
                $elements->add($sortOrder, $lastInputParamId);
            }
        }

        return $result;
    }
}
