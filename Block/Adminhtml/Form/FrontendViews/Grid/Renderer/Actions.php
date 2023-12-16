<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Adminhtml\Form\FrontendViews\Grid\Renderer;

/**
 *
 */
class Actions extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\Action
{
    public function render(\Magento\Framework\DataObject $row)
    {
        $actions = [
            '<a href = "#" onclick=\'
                 document.frontendViewId = ' . $row->getId() . '
                 document.dispatchEvent(new Event("open_frontend_view_modal"));
                 return false;
             \'>' . __('Edit') . '</a>',
            '<a href = "#" onclick=\'
                 document.frontendViewId = ' . $row->getId() . '
                 document.dispatchEvent(new Event("delete_frontend_view"));
                 return false;
             \'>' . __('Delete') . '</a>'
        ];
        return implode(' | ', $actions);
    }
}
