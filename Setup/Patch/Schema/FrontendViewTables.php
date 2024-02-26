<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
declare(strict_types=1);

namespace Alekseon\CustomFormsFrontend\Setup\Patch\Schema;

use Alekseon\AlekseonEav\Setup\EavSchemaSetup;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Alekseon\AlekseonEav\Setup\EavSchemaSetupFactory;

class FrontendViewTables implements SchemaPatchInterface
{
    /**
     * @var SchemaSetupInterface
     */
    private $schemaSetup;
    /**
     * @var EavSchemaSetupFactory
     */
    private $eavSetupFactory;

    /**
     * EnableSegmentation constructor.
     *
     * @param SchemaSetupInterface $schemaSetup
     */
    public function __construct(
        SchemaSetupInterface $schemaSetup,
        EavSchemaSetupFactory $eavSetupFactory
    ) {
        $this->schemaSetup = $schemaSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @return CreateEavTables|void
     */
    public function apply()
    {
        $this->schemaSetup->startSetup();
        $setup = $this->schemaSetup;

        /** @var EavSchemaSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $eavSetup->createEavEntitiesTables(
            'alekseon_custom_form_attribute',
            'alekseon_custom_form_frontend_view_entity',
            null,
            'alekseon_custom_form_frontend_view',
        );

        $this->schemaSetup->endSetup();
    }


    /**
     * @return array
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @return array
     */
    public static function getDependencies()
    {
        return [];
    }
}
