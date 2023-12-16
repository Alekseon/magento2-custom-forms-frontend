<?php

/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\CustomFormsFrontend\Block\Adminhtml\Form\FrontendViews\Edit;

/**
 *
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'frontend_view_form',
                    'action' => $this->getSaveUrl(),
                    'method' => 'post'
                ]
            ]
        );

        $form->addField(
            'entity_id',
            'hidden',
            [
                'name' => 'view_id'
            ]
        );

        $form->addValues(
            [
                'entity_id' => $this->getCurrentFrontendView()->getId(),
            ]
        );
        $this->setForm($form);
        $this->getForm()->setUseContainer(true);

        return parent::_prepareForm();
    }

    public function getCurrentFrontendView()
    {
        return $this->_coreRegistry->registry('current_frontend_view');
    }

    /**
     * @return string
     */
    public function getSaveUrl()
    {
        return $this->getUrl('*/*/save');
    }
}
