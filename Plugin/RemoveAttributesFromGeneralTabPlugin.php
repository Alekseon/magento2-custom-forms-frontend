<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Plugin;

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
    public function beforeAddAllAttributeFields($generalTabBlock, $generalFieldset, $formObject, $groups = []): array
    {
        $groups['excluded'][] = 'frontend_view_list';
        return [$generalFieldset, $formObject, $groups];
    }
}
