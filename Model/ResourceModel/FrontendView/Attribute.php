<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Model\ResourceModel\FrontendView;

class Attribute extends \Alekseon\CustomFormsBuilder\Model\ResourceModel\Form\Attribute
{
    /**
     * @var string
     */
    protected $entityTypeCode = 'alekseon_custom_form_frontend_view';
    /**
     * @var string
     */
    protected $backendTablePrefix = 'alekseon_custom_form_frontend_view_entity';
}
