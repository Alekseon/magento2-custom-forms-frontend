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
     * @param callable $proceed
     * @param FormRecord $formRecord
     * @return string
     */
    public function aroundGetSuccessMessage(Submit $submitAction, callable $proceed, FormRecord $formRecord)
    {
        $this->templateFilter->setFormRecord($formRecord);
        $message = (string) $proceed($formRecord);
        return $this->templateFilter->filter($message);
    }

    /**
     * @param Submit $submitAction
     * @param callable $proceed
     * @param FormRecord $formRecord
     * @return string
     */
    public function aroundGetSuccessTitle(Submit $submitAction, callable $proceed, FormRecord $formRecord)
    {
        $this->templateFilter->setFormRecord($formRecord);
        $message = (string) $proceed($formRecord);
        return $this->templateFilter->filter($message);
    }
}
