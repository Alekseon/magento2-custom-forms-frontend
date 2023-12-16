<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Adminhtml\Form\Edit\Tab;

use Magento\Directory\Helper\Data as DirectoryHelper;
use Magento\Framework\Json\Helper\Data as JsonHelper;

class FrontendViews extends \Magento\Backend\Block\Template implements
    \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $coreRegistry
    )
    {
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('Frontend Views');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('Frontend Views');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    protected function _prepareLayout()
    {
        $this->setChild(
            'add_button',
            $this->getLayout()->createBlock(\Magento\Backend\Block\Widget\Button::class)->setData(
                [
                    'label' => __('Add New Frontend View'),
                    'class' => 'primary',
                    'id' => 'add_frontend_view_button'
                ]
            )
        );

        return parent::_prepareLayout();
    }


    public function getFormId()
    {
        return $this->coreRegistry->registry('current_form')->getId();
    }
}
