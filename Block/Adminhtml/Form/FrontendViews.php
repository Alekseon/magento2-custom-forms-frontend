<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Adminhtml\Form;

/**
 *
 */
class FrontendViews extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_form_frontendViews';
        $this->_blockGroup = 'Alekseon_CustomFormsFrontend';
        $this->_headerText = __('Frontend Views');
        parent::_construct();
        $this->removeButton('add');
    }
}
