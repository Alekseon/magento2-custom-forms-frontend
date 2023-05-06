<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Plugin;

use Alekseon\CustomFormsBuilder\Model\FormRecord;
use Alekseon\WidgetForms\Controller\Form\Submit;

/**
 * Class WidgetFormSubmitPlugin
 * @package Alekseon\CustomFormsFrontend\Plugin
 */
class WidgetFormSubmitPlugin
{
    /**
     * @var \Alekseon\CustomFormsFrontend\Model\Template\Filter
     */
    private $templateFilter;

    /**
     * WidgetFormSubmitPlugin constructor.
     * @param \Alekseon\CustomFormsFrontend\Model\Template\Filter $templateFilter
     */
    public function __construct(
        \Alekseon\CustomFormsFrontend\Model\Template\Filter $templateFilter
    )
    {
        $this->templateFilter = $templateFilter;
    }

    /**
     * @param Submit $submitAction
     * @param $message
     * @param FormRecord $formRecord
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetSuccessMessage(Submit $submitAction, $message, FormRecord $formRecord)
    {
        $this->templateFilter->setFormRecord($formRecord);
        return $this->templateFilter->filter($message);
    }

    /**
     * @param Submit $submitAction
     * @param $title
     * @param FormRecord $formRecord
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetSuccessTitle(Submit $submitAction, $title, FormRecord $formRecord)
    {
        $this->templateFilter->setFormRecord($formRecord);
        return $this->templateFilter->filter($title);
    }
}
