<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);
namespace Alekseon\CustomFormsFrontend\Setup\Patch\Data;

use Alekseon\AlekseonEav\Model\Adminhtml\System\Config\Source\Scopes;
use Alekseon\AlekseonEav\Setup\EavDataSetup;
use Alekseon\CustomFormsBuilder\Model\Form\AttributeRepository;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Alekseon\AlekseonEav\Setup\EavDataSetupFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class FrontendViewAttributesPatch  implements DataPatchInterface, PatchRevertableInterface
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
            'frontend_view_list_row_content',
            [
                'frontend_input' => 'textarea',
                'frontend_label' => 'Row Content',
                'backend_type' => 'text',
                'visible_in_grid' => false,
                'is_required' => false,
                'sort_order' => 30,
                'scope' => Scopes::SCOPE_STORE,
                'group_code' => 'frontend_view_list',
            ]
        );

        $eavSetup->createAttribute(
            'frontend_view_list_sort_by',
            [
                'frontend_input' => 'select',
                'frontend_label' => 'Sort By',
                'backend_type' => 'int',
                'visible_in_grid' => false,
                'is_required' => false,
                'sort_order' => 32,
                'source_model' => 'Alekseon\CustomFormsFrontend\Model\Attribute\Source\FrontendView\List\SortBy',
                'scope' => Scopes::SCOPE_GLOBAL,
                'group_code' => 'frontend_view_list',
            ]
        );

        $eavSetup->createAttribute(
            'frontend_view_list_limit',
            [
                'frontend_input' => 'text',
                'frontend_label' => 'Rows Limit',
                'backend_type' => 'int',
                'visible_in_grid' => false,
                'is_required' => false,
                'sort_order' => 33,
                'scope' => Scopes::SCOPE_GLOBAL,
                'group_code' => 'frontend_view_list',
            ]
        );

        $eavSetup->createAttribute(
            'frontend_view_list_page_size',
            [
                'frontend_input' => 'text',
                'frontend_label' => 'Page Size',
                'backend_type' => 'int',
                'visible_in_grid' => false,
                'is_required' => false,
                'sort_order' => 34,
                'scope' => Scopes::SCOPE_GLOBAL,
                'group_code' => 'frontend_view_list',
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
        $eavSetup->deleteAttribute('frontend_view_list_row_content');
        $eavSetup->deleteAttribute('frontend_view_list_sort_by');
        $eavSetup->deleteAttribute('frontend_view_list_limit');
        $eavSetup->deleteAttribute('frontend_view_list_page_size');
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
