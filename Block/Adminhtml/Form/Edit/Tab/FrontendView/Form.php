<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Adminhtml\Form\Edit\Tab\FrontendView;

class Form extends \Alekseon\AlekseonEav\Block\Adminhtml\Entity\Edit\Form
{
    /**
     * @return mixed
     */
    public function getDataObject()
    {
        return $this->_coreRegistry->registry('current_form');
    }

    protected function _prepareForm(): self
    {
        $form = $this->_formFactory->create();
        $dataObject = $this->getDataObject();

        $adminConfirmationEmailFieldset = $form->addFieldset('list_view',
            ['legend' => __('List View')]
        );

        $this->addAllAttributeFields($adminConfirmationEmailFieldset, $dataObject, ['included' => ['frontend_view_list']]);

        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * @return Form
     */
    protected function _initFormValues()
    {
        $data = $this->getDataObject()->getData();
        $this->getForm()->addValues($data);
        return parent::_initFormValues();
    }
}
