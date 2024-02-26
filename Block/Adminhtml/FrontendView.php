<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Adminhtml;

class FrontendView extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

    /**
     * FormRecord constructor.
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        array $data = []
    ) {
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_frontendView';
        $this->_blockGroup = 'Alekseon_CustomFormsFrontend';
        $this->_headerText = __('Frontend Views');
        $this->_addButtonLabel = __('Add New Frontend View');
        parent::_construct();
    }

    /**
     * @return string
     */
    public function getCreateUrl()
    {
        return $this->getUrl('*/*/new', ['form_id' => $this->getCurrentForm()->getId()]);
    }

    /**
     * @return mixed
     */
    public function getCurrentForm()
    {
        return $this->coreRegistry->registry('current_form');
    }
}
