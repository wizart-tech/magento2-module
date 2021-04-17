<?php

declare(strict_types = 1);

namespace Wizart\EntryPointButton\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface as ScopedAttributeInterfaceMagento;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean as BooleanMagento;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class AddVisualizeAttribute implements DataPatchInterface, PatchRevertableInterface
{
    protected const ATTRIBUTE_CODE = 'wizart_visualize';
    protected const GROUP_NAME = 'Wizart';
    protected const ATTRIBUTE_LABEL = 'Visualize';

    /**
     * @var ModuleDataSetupInterface
     */
    protected $moduleDataSetup;

    /**
     * @var EavSetupFactory
     */
    protected $eavSetupFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(ModuleDataSetupInterface $moduleDataSetup, EavSetupFactory $eavSetupFactory)
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @return array
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @return void
     */
    public function apply(): void
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        /** @var EavSetup $eavSetup */
        $eavSetup = $this->getEavSetupFactory();

        $eavSetup->removeAttribute(Product::ENTITY, static::ATTRIBUTE_CODE);
        $eavSetup->addAttribute(
            Product::ENTITY,
            static::ATTRIBUTE_CODE,
            [
                'group' => static::GROUP_NAME,
                'type' => 'int',
                'backend' => '',
                'frontend' => '',
                'label' => static::ATTRIBUTE_LABEL,
                'input' => 'boolean',
                'class' => '',
                'source' => BooleanMagento::class,
                'global' => ScopedAttributeInterfaceMagento::SCOPE_STORE,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'default' => 0,
                'searchable' => true,
                'filterable' => true,
                'comparable' => false,
                'visible_on_front' => false,
                'is_used_in_grid' => true,
                'is_filterable_in_grid' => true,
                'unique' => false,
            ]
        );

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @throws \Exception
     *
     * @return void
     */
    public function revert(): void
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        /** @var EavSetup $eavSetup */
        $eavSetup = $this->getEavSetupFactory();
        $eavSetup->removeAttribute(Product::ENTITY, static::ATTRIBUTE_CODE);

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @return array
     */
    public function getAliases(): array
    {
        return [];
    }

    /**
     * @return EavSetup
     */
    private function getEavSetupFactory(): EavSetup
    {
        return $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
    }
}
