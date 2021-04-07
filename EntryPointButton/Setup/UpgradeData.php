<?php

declare(strict_types = 1);

namespace Wizart\EntryPointButton\Setup;

use Magento\Catalog\Model\Product as ProductMagento;
use Magento\Catalog\Setup\CategorySetup;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Catalog\Setup\UpgradeWebsiteAttributes;
use Magento\Catalog\Setup\UpgradeWidgetData;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface as ScopedAttributeInterfaceMagento;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean as BooleanMagento;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * Category setup factory
     *
     * @var CategorySetupFactory
     */
    private $categorySetupFactory;

    /**
     * EAV setup factory
     *
     * @var \Magento\Eav\Setup\EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @var UpgradeWidgetData
     */
    private $upgradeWidgetData;

    /**
     * @var UpgradeWebsiteAttributes
     */
    private $upgradeWebsiteAttributes;

    /**
     * Constructor
     *
     * @param CategorySetupFactory $categorySetupFactory
     * @param \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
     * @param UpgradeWidgetData $upgradeWidgetData
     * @param UpgradeWebsiteAttributes $upgradeWebsiteAttributes
     */
    public function __construct(
        CategorySetupFactory $categorySetupFactory,
        \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory,
        UpgradeWidgetData $upgradeWidgetData,
        UpgradeWebsiteAttributes $upgradeWebsiteAttributes
    ) {
        $this->categorySetupFactory = $categorySetupFactory;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->upgradeWidgetData = $upgradeWidgetData;
        $this->upgradeWebsiteAttributes = $upgradeWebsiteAttributes;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '0.4.0', '<')) {
            $this->upgradeTo020($setup);
        }

        $setup->endSetup();
    }

    public function upgradeTo020($setup)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            ProductMagento::ENTITY,
            'wizart_visualize',
            [
                'group' => 'Wizart',
                'type' => 'int',
                'backend' => '',
                'frontend' => '',
                'label' => 'Visualize',
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

        /** @var CategorySetup $categorySetup */
        $categorySetup = $this->categorySetupFactory->create(['setup' => $setup]);
        $attributeSetId = $categorySetup->getDefaultAttributeSetId(ProductMagento::ENTITY);
        $categorySetup->addAttributeToGroup(
            ProductMagento::ENTITY,
            $attributeSetId,
            'Wizart',
            'wizart_is_visualize',
            10
        );
    }
}
