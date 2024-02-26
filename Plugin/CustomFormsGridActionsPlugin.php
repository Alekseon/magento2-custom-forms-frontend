<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Plugin;

use Alekseon\CustomFormsBuilder\Block\Adminhtml\Form\Grid\Renderer\Actions;

class CustomFormsGridActionsPlugin
{
    /**
     * @param Actions $actionsRenderer
     * @param array $result
     * @param \Magento\Framework\DataObject $row
     * @return array
     */
    public function afterGetActionsArray(Actions $actionsRenderer, $result, \Magento\Framework\DataObject $row)
    {
        $result[] = '<a href = "'
            . $actionsRenderer->getUrl('*/frontendView', ['form_id' => $row->getId()])
            . '">' . __('Frontend Views')
            . '</a>';
        return $result;
    }
}
