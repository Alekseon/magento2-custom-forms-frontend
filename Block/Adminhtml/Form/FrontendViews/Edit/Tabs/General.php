<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Adminhtml\Form\FrontendViews\Edit\Tabs;

use Magento\Backend\Block\Widget\Tab\TabInterface;

/**
 *
 */
class General extends \Magento\Backend\Block\Widget\Form\Generic implements TabInterface
{
    /**
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setFieldNameSuffix('frontend_view');

        $generalFieldset = $form->addFieldset(
            'general_fieldset',
            ['legend' => __('Fieldset'), 'class' => 'fieldset-wide']
        );

        $generalFieldset->addField(
            'title',
            'text',
            [
                'label' => __('Title'),
                'title' => __('Title'),
                'name' => 'title',
                'required' => true,
            ]
        );

        $generalFieldset->addField(
            'row_content',
            'textarea',
            [
                'label' => __('Row Content'),
                'title' => __('Row Content'),
                'name' => 'row_content',
            ]
        );

        $form->addValues($this->getCurrentFrontendView()->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * @return mixed|null
     */
    public function getCurrentFrontendView()
    {
        return $this->_coreRegistry->registry('current_frontend_view');
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getTabLabel()
    {
        return __('General');
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getTabTitle()
    {
        return __('General');
    }

    /**
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }
}
