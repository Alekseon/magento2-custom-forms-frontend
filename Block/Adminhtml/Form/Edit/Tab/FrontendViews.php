<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Adminhtml\Form\Edit\Tab;

class FrontendViews extends \Magento\Backend\Block\Template implements
    \Magento\Backend\Block\Widget\Tab\TabInterface
{
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
}
