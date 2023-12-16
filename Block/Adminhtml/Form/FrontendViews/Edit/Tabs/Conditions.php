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
class Conditions extends \Magento\Backend\Block\Widget\Form\Generic implements TabInterface
{
    /**
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $generalFieldset = $form->addFieldset(
            'general_fieldset',
            ['legend' => __(''), 'class' => 'fieldset-wide']
        );


        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getTabLabel()
    {
        return __('Conditions');
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getTabTitle()
    {
        return __('Conditions');
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
