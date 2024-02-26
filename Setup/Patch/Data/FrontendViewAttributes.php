<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Setup\Patch\Data;

use Alekseon\AlekseonEav\Model\Adminhtml\System\Config\Source\Scopes;
use Alekseon\AlekseonEav\Setup\EavDataSetup;
use Alekseon\CustomFormsFrontend\Model\FrontendView\AttributeRepository;
use Alekseon\AlekseonEav\Setup\EavDataSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class FrontendViewAttributes implements DataPatchInterface, PatchRevertableInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var EavDataSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @var AttributeRepository
     */
    private $formAttributeRepository;

    /**
     * @param EavDataSetupFactory $eavSetupFactory
     * @param AttributeRepository $formAttributeRepository
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavDataSetupFactory $eavSetupFactory,
        AttributeRepository $formAttributeRepository
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->formAttributeRepository = $formAttributeRepository;
    }

    /**
     * @inheritdoc
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        /** @var EavDataSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->setAttributeRepository($this->formAttributeRepository);

        $eavSetup->createAttribute(
            'name',
            [
                'frontend_input' => 'text',
                'frontend_label' => 'Name',
                'visible_in_grid' => true,
                'is_required' => true,
                'sort_order' => 10,
                'scope' => Scopes::SCOPE_GLOBAL,
            ]
        );

        $eavSetup->createAttribute(
            'content',
            [
                'frontend_input' => 'textarea',
                'frontend_label' => 'Row Content',
                'backend_type' => 'text',
                'visible_in_grid' => false,
                'is_required' => false,
                'sort_order' => 20,
                'scope' => Scopes::SCOPE_STORE,
            ]
        );

        $eavSetup->createAttribute(
            'sort_by',
            [
                'frontend_input' => 'select',
                'frontend_label' => 'Sort By',
                'backend_type' => 'int',
                'visible_in_grid' => false,
                'is_required' => false,
                'sort_order' => 30,
                'source_model' => 'Alekseon\CustomFormsFrontend\Model\Attribute\Source\FrontendView\SortBy',
                'scope' => Scopes::SCOPE_GLOBAL,
            ]
        );

        $eavSetup->createAttribute(
            'conditions',
            [
                'frontend_input' => 'text',
                'frontend_label' => 'Conditions',
                'backend_type' => 'text',
                'backend_model' => 'Alekseon\AlekseonEav\Model\Attribute\Backend\Serialized',
                'visible_in_grid' => false,
                'is_required' => false,
                'sort_order' => 100,
                'scope' => Scopes::SCOPE_GLOBAL,
            ]
        );

        $this->moduleDataSetup->getConnection()->endSetup();
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function revert()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->setAttributeRepository($this->formAttributeRepository);
        $eavSetup->deleteAttribute('name');
        $eavSetup->deleteAttribute('content');
        $eavSetup->deleteAttribute('sort_by');
        $eavSetup->deleteAttribute('conditions');
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }
}
