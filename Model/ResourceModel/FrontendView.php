<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Model\ResourceModel;

/**
 * Class Form
 * @package Alekseon\CustomFormsBuilder\Model\ResourceModel
 */
class FrontendView extends \Alekseon\AlekseonEav\Model\ResourceModel\Entity
{
    /**
     * @var string
     */
    protected $entityTypeCode = 'alekseon_custom_form_frontend_view';

    /**
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param FrontendView\Attribute\CollectionFactory $attributeCollectionFactory
     * @param $connectionName
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Alekseon\CustomFormsFrontend\Model\ResourceModel\FrontendView\Attribute\CollectionFactory $attributeCollectionFactory,
        $connectionName = null
    ) {
        $this->attributeCollectionFactory = $attributeCollectionFactory;
        parent::__construct($context, $connectionName);
    }

    /**
     * @return void
     */
    protected function _construct() // @codingStandardsIgnoreLine
    {
        $this->_init('alekseon_custom_form_frontend_view', 'entity_id');
    }
}
