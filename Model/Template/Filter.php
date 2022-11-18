<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\CustomFormsFrontend\Model\Template;

use Alekseon\CustomFormsBuilder\Model\FormRecord;

/**
 * Class Filter
 * @package Alekseon\CustomFormsFrontend\Model\Template
 */
class Filter extends \Magento\Email\Model\Template\Filter
{
    /**
     * @var
     */
    protected $formRecord;
    /**
     * @var array
     */
    protected $formRecordsAttributes = [];

    /**
     * @param array $variables
     * @return Filter|void
     */
    public function setVariables(array $variables)
    {
        if (isset($variables['record'])) {
            $this->setFormRecord($variables['record']);
        }
        parent::setVariables($variables);
    }

    /**
     * @param FormRecord $formRecord
     * @return $this
     */
    public function setFormRecord(FormRecord $formRecord)
    {
        $this->formRecordsAttributes = [];
        $this->formRecord = $formRecord;
        $formRecordsAttributes = $formRecord->getResource()->getAllLoadedAttributes();
        foreach ($formRecordsAttributes as $attribute) {
            $this->formRecordsAttributes[$attribute->getAttributeCode()] = $attribute;
            if ($attribute->getIdentifier()) {
                $this->formRecordsAttributes[$attribute->getIdentifier()] = $attribute;
            }
        }
        return $this;
    }

    /**
     * @return false
     */
    public function getFrontendBlockRepository()
    {
        /**
         * frontend block repository is set by plugin
         */
        return false;
    }

    /**
     * @param $construction
     */
    public function formTitleDirective($construction)
    {
        if (!$this->formRecord) {
            return '';
        }

        return $this->formRecord->getForm()->getTitle();
    }

    /**
     * @param $construction
     */
    public function fieldLabelDirective($construction)
    {
        if (!$this->formRecord) {
            return '';
        }

        $parameters = $this->getParameters($construction[2]);
        if (isset($parameters['id'])) {
            $recordAttribute = $this->getRecordAttribute($parameters['id']);
            if ($recordAttribute) {
                if (isset($parameters['admin'])) {
                    return $recordAttribute->getDefaultFrontendLabel();
                } else {
                    return $recordAttribute->getFrontendLabel();
                }
            }
        }

        return '';
    }

    /**
     * @param $construction
     * @return string
     */
    public function fieldValueDirective($construction)
    {
        if (!$this->formRecord) {
            return '';
        }

        $frontendBlocksRepository = $this->getFrontendBlockRepository();
        if (!$frontendBlocksRepository) {
            return '';
        }

        $block = false;
        $parameters = $this->getParameters($construction[2]);
        if (isset($parameters['id'])) {
            $recordAttribute = $this->getRecordAttribute($parameters['id']);

            if ($recordAttribute) {
                $frontendBlock = $this->getFrontendBlockRepository()->getFrontendBlock($recordAttribute);
                if ($frontendBlock) {
                    $blockName = $recordAttribute->getAttributeCode();
                    $block = $this->_layout->getBlock($blockName);
                    if (!$block) {
                        $block = $this->_layout->createBlock($frontendBlock['class'], $blockName, $frontendBlock);
                    }
                    if (isset($frontendBlock['template'])) {
                        $block->setTemplate($frontendBlock['template']);
                    }
                    if (isset($parameters['admin'])) {
                        $block->setStoreId(0);
                    } else {
                        $block->setStoreId($this->getStoreId());
                    }

                    $block->setRecordAttribute($recordAttribute);
                    $block->setFormRecord($this->formRecord);
                    $block->setParameters($parameters);
                }
            }

            if ($block) {
                return $block->toHtml();
            }

            return '';
        }
    }

    /**
     * @param $id
     */
    protected function getRecordAttribute($id)
    {
        if (isset($this->formRecordsAttributes[$id])) {
            $fieldId = $id;
        } else {
            $fieldId = 'field_' . $this->formRecord->getForm()->getId() . '_' . $id;
        }

        if (isset($this->formRecordsAttributes[$fieldId])) {
            return $this->formRecordsAttributes[$fieldId];
        }

        return false;
    }
}
