<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\CustomFormsFrontend\Block\Adminhtml\Form\FrontendViews\Edit;

/**
 * Class Tabs
 * @package Alekseon\Multistock\Block\Adminhtml\Stock\Edit
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected $_template = 'Magento_Backend::widget/tabshoriz.phtml';

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('edit_frontend_view_tabs');
        $this->setDestElementId('frontend_view_form');
        $this->setTitle(__('Frontend Views'));
    }
}
