<?php

declare(strict_types=1);

namespace Wizart\EntryPointButton\Block\CatalogPage;


use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Block\Product\AwareInterface as ProductAwareInterface;
use Magento\Catalog\Model\Product;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Wizart\EntryPointButton\Helper\Config\CatalogPage\EntryPointButton;
use Wizart\General\Block\AbstractButtonsTemplate;
use Wizart\General\Helper\Config\GeneralConfig;
use Wizart\PIMConnector\Helper\Connector;

class EntryPointButtonBlock extends AbstractButtonsTemplate implements ProductAwareInterface
{
    /**
     * @var Registry
     */
    private $coreRegistry;

    /**
     * @var Connector
     */
    private $pimConnector;

    /** @var Product */
    private $product;

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

    public function getTitle(): string
    {
        return $this->buttonConfig->getTitle();
    }

    public function getProduct(): ?Product
    {
        if (null !== $this->product) {
            return $this->product;
        }

        $product = $this->coreRegistry->registry('product');
        if (!$product instanceof Product) {
            return null;
        }

        return $product;
    }

    public function setProduct(ProductInterface $product): void
    {
        $this->product = $product;
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
