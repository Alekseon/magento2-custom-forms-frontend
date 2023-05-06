<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Plugin;

use Alekseon\CustomFormsEmailNotification\Model\Email\EmailNotification;
use Alekseon\CustomFormsFrontend\Model\FrontendBlocksRepository;
use Alekseon\CustomFormsFrontend\Model\Template\Filter;

/**
 * Class EmailNotificationPlugin
 * @package Alekseon\CustomFormsFrontend\Plugin
 */
class EmailNotificationPlugin
{
    /**
     * @var FrontendBlocksRepository
     */
    private $frontendBlocksRepository;
    /**
     * @var Filter
     */
    private $templateFilter;

    /**
     * TemplateFilterPlugin constructor.
     * @param FrontendBlocksRepository $frontendBlocksRepository
     */
    public function __construct(
        FrontendBlocksRepository $frontendBlocksRepository,
        Filter $templateFilter
    )
    {
        $this->frontendBlocksRepository = $frontendBlocksRepository;
        $this->templateFilter = $templateFilter;
    }

    /**
     * This is plugin for alekseon/custom-forms-email-notification in version below 100.2.0
     * @param $emailNotification
     * @param array $templateParams
     * @return array[]
     */
    public function beforeSendNotificationEmail(EmailNotification $emailNotification, array $templateParams = [])
    {
        $templateParams = $this->getTemplateParamsWithRecordHtml($templateParams);
        return [$templateParams];
    }

    /**
     * This is plugin for alekseon/custom-forms-email-notification in version 100.2.0 and above
     * @param EmailNotification $emailNotification
     * @param $templateParams
     * @return mixed
     */
    public function afterGetTemplateParams(EmailNotification $emailNotification, $templateParams)
    {
        return $this->getTemplateParamsWithRecordHtml($templateParams);
    }

    /**
     * @param array $templateParams
     * @return array
     */
    private function getTemplateParamsWithRecordHtml($templateParams = [])
    {
        if (isset($templateParams['record'])) {
            $formRecord = $templateParams['record'];
            $attributes = $formRecord->getResource()->getAllLoadedAttributes();
            $recordHtml = '<div class="form-record">';
            foreach ($attributes as $attribute) {
                if ($formRecord->getData($attribute->getAttributeCode())) {
                    if ($this->frontendBlocksRepository->getFrontendBlock($attribute)) {
                        $recordHtml .= '<div class="form-record-row">';
                        $recordHtml .= '<strong>{{fieldLabel id="' . $attribute->getAttributeCode() . '" admin="1"}}</strong>';
                        $recordHtml .= ': ';
                        $recordHtml .= '{{fieldValue id="' . $attribute->getAttributeCode() . '" admin="1"}}';
                        $recordHtml .= '</div>';
                    }
                }
            }
            $recordHtml .= '</div>';

            $this->templateFilter->setFormRecord($formRecord);
            $templateParams['recordHtml'] = $this->templateFilter->filter($recordHtml);
        }
        return $templateParams;
    }
}
