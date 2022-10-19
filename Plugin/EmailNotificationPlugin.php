<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\CustomFormsFrontend\Plugin;

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
    protected $frontendBlocksRepository;
    /**
     * @var Filter
     */
    protected $templateFilter;

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
     * @param $emailNotification
     * @param array $templateParams
     * @return array[]
     */
    public function beforeSendNotificationEmail($emailNotification, array $templateParams = [])
    {
        if (isset($templateParams['record'])) {
            $formRecord = $templateParams['record'];
            $attributes = $formRecord->getResource()->getAllLoadedAttributes();
            $recordHtml = '<div class="form-record">';
            foreach ($attributes as $attribute) {
                if ($formRecord->getData($attribute->getAttributeCode())) {
                    $recordHtml .= '<div class="form-record-row">';
                    $recordHtml .= '<strong>{{fieldLabel id="' . $attribute->getAttributeCode() . '" admin="1"}}</strong>';
                    $recordHtml .= ': ';
                    $recordHtml .= '{{fieldValue id="' . $attribute->getAttributeCode() . '" admin="1"}}';
                    $recordHtml .= '</div>';
                }
            }
            $recordHtml .= '</div>';

            $this->templateFilter->setFormRecord($formRecord);
            $templateParams['recordHtml'] = $this->templateFilter->filter($recordHtml);
        }

        return [$templateParams];
    }
}
