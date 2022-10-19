<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
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
    protected $templateFilter;

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
     * @return mixed
     */
    public function aroundGetSuccessMessage(Submit $submitAction, callable $proceed, FormRecord $formRecord)
    {
        $this->templateFilter->setFormRecord($formRecord);
        $message = $proceed($formRecord);
        return $this->templateFilter->filter($message);
    }

    /**
     * @param Submit $submitAction
     * @param $message
     * @return mixed
     */
    public function aroundGetFailureMessage(Submit $submitAction, callable $proceed, FormRecord $formRecord)
    {
        $this->templateFilter->setFormRecord($formRecord);
        $message = $proceed($formRecord);
        return $this->templateFilter->filter($message);
    }
}
