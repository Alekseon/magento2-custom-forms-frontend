<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Adminhtml\Form\Edit\Tab\FrontendView;

use Magento\Backend\Block\Widget\Form\Renderer\Fieldset;

class Conditions extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Rule\Block\Conditions
     */
    private $conditions;
    /**
     * @var \Alekseon\CustomFormsFrontend\Model\Form\FrontendView\Condition
     */
    private $conditionFactory;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Rule\Block\Conditions $conditions
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Rule\Block\Conditions $conditions,
        \Alekseon\CustomFormsFrontend\Model\Form\FrontendView\ConditionFactory $conditionFactory,
        array $data = []
    ) {
        $this->conditions = $conditions;
        $this->conditionFactory = $conditionFactory;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        $currentForm = $this->_coreRegistry->registry('current_form');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $conditionsFieldSetId = 'condition_fieldset';

        $newChildUrl = $this->getUrl(
            'alekseon_customFormsFrontend/form_frontendView/newConditionHtml/form/' . $conditionsFieldSetId,
            [
                'form_id' => $currentForm->getId(),
                'store' => $currentForm->getStoreId()
            ]
        );

        $renderer = $this->getLayout()->createBlock(Fieldset::class);
        $renderer->setTemplate('Alekseon_CustomFormsFrontend::form/edit/tab/frontend_view/conditions/fieldset.phtml')
            ->setNewChildUrl($newChildUrl)
            ->setFieldSetId($conditionsFieldSetId);

        $conditionsFieldset = $form->addFieldset(
            $conditionsFieldSetId,
            ['legend' => __('Conditions')]
        )->setRenderer($renderer);

        $condition = $this->conditionFactory->create();
        $condition->loadPost($currentForm->getFrontendViewConditions());

        $element = $conditionsFieldset->addField(
            'conditions',
            'text',
            [
                'name' => 'conditions',
                'label' => __('Conditions'),
                'title' => __('Conditions'),
            ]
        )->setRenderer(
            $this->conditions
        );

        $element->setRule($condition);
        $form->setValues($currentForm->getData());

        $this->setForm($form);
        return parent::_prepareForm();
    }
}
