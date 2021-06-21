<?php

declare(strict_types=1);

namespace Wizart\EntryPointButton\Block\ProductPage;


use Magento\Catalog\Model\Product;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Wizart\EntryPointButton\Block\AbstractEntryPointButtonBlock;
use Wizart\EntryPointButton\Helper\Config\ProductPage\EntryPointButton;
use Wizart\General\Helper\Config\GeneralConfig;

class EntryPointButtonBlock extends AbstractEntryPointButtonBlock
{
    /**
     * @var Registry
     */
    private $coreRegistry;

    public function __construct(
        Template\Context $context,
        EntryPointButton $buttonConfig,
        GeneralConfig $generalConfig,
        Registry $coreRegistry,
        $dataAttributes = [],
        array $data = []
    ) {
        parent::__construct($context, $buttonConfig, $generalConfig, $dataAttributes, $data);
        $this->coreRegistry = $coreRegistry;
    }

    /**
     * @inheritDoc
     */
    public function getProduct()
    {
        $product = $this->coreRegistry->registry('product');
        if (!$product instanceof Product) {
            return null;
        }

        return $product;
    }
}
