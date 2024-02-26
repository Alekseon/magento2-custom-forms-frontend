<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Adminhtml\FrontendView\Edit\Tab\General;

class Form extends \Alekseon\AlekseonEav\Block\Adminhtml\Entity\Edit\Form
{
    protected $dataObject;

    /**
     * @return mixed
     */
    public function getDataObject()
    {
        if (null === $this->dataObject) {
            return $this->_coreRegistry->registry('current_frontend_view');
        }
        return $this->dataObject;
    }

    /**
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        $dataObject = $this->getDataObject();

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $baseFieldset = $form->addFieldset('base_fieldset', ['legend' => __('Frontend View Properties')]);

        $this->addAllAttributeFields($baseFieldset, $dataObject);
        $baseFieldset->removeField('conditions');

        $form->addField('form_id', 'hidden', ['name' => 'form_id']);
        if ($dataObject->getId()) {
            $form->addField('entity_id', 'hidden', ['name' => 'entity_id']);
        }

        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Initialize form fileds values
     *
     * @return $this
     */
    protected function _initFormValues()
    {
        $this->getForm()->addValues($this->getDataObject()->getData());
        return parent::_initFormValues();
    }
}
