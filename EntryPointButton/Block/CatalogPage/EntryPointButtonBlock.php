<?php

declare(strict_types=1);

namespace Wizart\EntryPointButton\Block\CatalogPage;


use Magento\Catalog\Model\Product;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Wizart\EntryPointButton\Helper\Config\ProductPage\EntryPointButton;
use Wizart\General\Block\AbstractButtonsTemplate;
use Wizart\General\Helper\Config\GeneralConfig;
use Wizart\PIMConnector\Helper\Connector;

class EntryPointButtonBlock extends AbstractButtonsTemplate
{
    /**
     * @var Registry
     */
    private $coreRegistry;

    /**
     * @var Connector
     */
    private $pimConnector;

    public function __construct(
        Template\Context $context,
        EntryPointButton $buttonConfig,
        GeneralConfig $generalConfig,
        Registry $coreRegistry,
        Connector $pimConnector,
        $dataAttributes = [],
        array $data = []
    ) {
        parent::__construct($context, $buttonConfig, $generalConfig, $dataAttributes, $data);
        $this->coreRegistry = $coreRegistry;
        $this->pimConnector = $pimConnector;
    }

    public function isEnabled(): bool
    {
        return parent::isEnabled();
    }

    public function getProduct(): ?Product
    {
        $product = $this->coreRegistry->registry('product');
        if (!$product instanceof Product) {
            return null;
        }

        return $product;
    }

    protected function isProductExist(): bool
    {
        $product = $this->getProduct();
        if (null === $product) {
            return false;
        }

        return $this->pimConnector->isProductAvailable($product->getSku());
    }
}
