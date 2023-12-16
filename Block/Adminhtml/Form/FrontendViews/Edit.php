<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Adminhtml\Form\FrontendViews;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_blockGroup = 'Alekseon_CustomFormsFrontend';
        $this->_objectId = 'entity_id';
        $this->_controller = 'adminhtml_form_frontendViews';
        parent::_construct();
    }

    public function getButtonsHtml($region = null)
    {
        return '';
    }
}
