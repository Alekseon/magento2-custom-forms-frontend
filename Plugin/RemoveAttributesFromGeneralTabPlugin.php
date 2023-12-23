<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Plugin;

use Magento\Framework\Data\Form\Element\Fieldset;

/**
 * Class RemoveAttributesFromGeneralTabPlugin
 * @package Alekseon\CustomFormsEmailNotification\Plugin
 */
class RemoveAttributesFromGeneralTabPlugin
{
    /**
     * @param $generalTabBlock
     * @param $generalFieldset
     * @param $formObject
     * @param array $groups
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeAddAllAttributeFields(
        \Alekseon\AlekseonEav\Block\Adminhtml\Entity\Edit\Form $generalTabBlock,
        $generalFieldset,
        $formObject,
        $groups = []
    ) {
        $groups['excluded'][] = 'frontend_view_list';
        return [$generalFieldset, $formObject, $groups];
    }

    public function afterAddAllAttributeFields(
        \Alekseon\AlekseonEav\Block\Adminhtml\Entity\Edit\Form $generalTabBlock,
        $result,
        Fieldset $generalFieldset
    ) {
        $generalFieldset->removeField('frontend_view_conditions');
        return $result;
    }
}
