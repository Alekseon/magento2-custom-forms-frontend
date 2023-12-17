<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Model\Form;

use Alekseon\CustomFormsBuilder\Model\Form\ResourceModel;
use Alekseon\CustomFormsBuilder\Model\FormRepository;

class FrontendView extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var
     */
    private $form;
    /**
     * @var FormRepository
     */
    private $formRepository;

    /**
     * @param \Alekseon\AlekseonEav\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Alekseon\CustomFormsFrontend\Model\ResourceModel\Form\FrontendView $resource
     * @param \Alekseon\CustomFormsFrontend\Model\ResourceModel\Form\FrontendView\Collection $resourceCollection
     * @param FormRepository $formRepository
     */
    public function __construct(
        \Alekseon\AlekseonEav\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Alekseon\CustomFormsFrontend\Model\ResourceModel\Form\FrontendView $resource,
        \Alekseon\CustomFormsFrontend\Model\ResourceModel\Form\FrontendView\Collection $resourceCollection,
        FormRepository $formRepository
    ) {
        $this->formRepository = $formRepository;
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection
        );
    }

    public function getForm()
    {
        if ($this->form === null) {
            $this->form = $this->formRepository->getById($this->getFormId());
        }
        return $this->form;
    }
}
