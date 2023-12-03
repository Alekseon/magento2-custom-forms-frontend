<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Block\Form\Field;

/**
 * Class Text
 * @package Alekseon\CustomFormsFrontend\Block\Form\Field
 */
class Image extends \Alekseon\CustomFormsFrontend\Block\Form\Field\AbstractField
{
    /**
     * @var string
     */
    protected $_template = "Alekseon_CustomFormsFrontend::form/field/image.phtml";

    /**
     * @return array|string[]
     */
    public function getDataValidateParams()
    {
        $dataValidateParams = [
            'alekseon-validate-form-filetype' => 'image'
        ];
        return array_merge($dataValidateParams, parent::getDataValidateParams());
    }
}
