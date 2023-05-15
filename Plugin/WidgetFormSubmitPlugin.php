<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Plugin;

use Alekseon\CustomFormsBuilder\Model\FormRecord;
use Magento\Framework\App\ActionInterface;

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
     * @param ActionInterface $submitAction
     * @param string $message
     * @param FormRecord $formRecord
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetSuccessMessage(ActionInterface $submitAction, string $message, FormRecord $formRecord)
    {
        $this->templateFilter->setFormRecord($formRecord);
        return $this->templateFilter->filter($message);
    }

    /**
     * @param ActionInterface $submitAction
     * @param string $title
     * @param FormRecord $formRecord
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetSuccessTitle(ActionInterface $submitAction, string $title, FormRecord $formRecord)
    {
        $this->templateFilter->setFormRecord($formRecord);
        return $this->templateFilter->filter($title);
    }
}
