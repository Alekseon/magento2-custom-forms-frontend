<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Field;

/**
 * Class Select
 * @package Alekseon\CustomFormsFrontend\Block\Field
 */
class Select extends \Alekseon\CustomFormsFrontend\Block\Field\Text
{
    /**
     *
     */
    public function getOptions()
    {
        $sourceModel = $this->getRecordAttribute()->getSourceModel();
        $sourceModel->setStoreId($this->getStoreId());
        if ($sourceModel) {
            return $sourceModel->getOptionArray();
        }
        return [];
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        $options = $this->getOptions();
        $value = parent::getValue();
        if (isset($options[$value])) {
            return $options[$value];
        }
        return '';
    }
}

