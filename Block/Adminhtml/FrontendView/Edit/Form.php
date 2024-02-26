<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Adminhtml\FrontendView\Edit;

class Form extends \Alekseon\AlekseonEav\Block\Adminhtml\Entity\Edit\Form
{
    /**
     * @inheritdoc
     */
    /**
     * @return mixed
     */
    public function getDataObject()
    {
        return $this->_coreRegistry->registry('current_frontend_view');
    }

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
                    'id' => 'edit_form',
                    'action' => $this->getData('action'),
                    'method' => 'post',
                ]
            ]
        );

        $dataObject = $this->getDataObject();

        $form->addField('form_id', 'hidden', ['name' => 'form_id']);
        if ($dataObject->getId()) {
            $form->addField('entity_id', 'hidden', ['name' => 'entity_id']);
        }

        $fieldset = $form->addFieldset('general_fieldset', ['legend' => __('Frontend View')]);
        $this->addAllAttributeFields($fieldset, $dataObject);

        $this->setForm($form);
        $this->getForm()->setUseContainer(true);

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
