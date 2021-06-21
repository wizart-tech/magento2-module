<?php

declare(strict_types=1);

namespace Wizart\EntryPointButton\Block\CatalogPage;


use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Block\Product\AwareInterface as ProductAwareInterface;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Wizart\EntryPointButton\Block\AbstractEntryPointButtonBlock;
use Wizart\EntryPointButton\Helper\Config\CatalogPage\EntryPointButton;
use Wizart\General\Helper\Config\GeneralConfig;

class EntryPointButtonBlock extends AbstractEntryPointButtonBlock implements ProductAwareInterface
{
    /**
     * @var Registry
     */
    private $coreRegistry;

    /** @var Product */
    private $product;

    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(
        Template\Context $context,
        EntryPointButton $buttonConfig,
        GeneralConfig $generalConfig,
        Registry $coreRegistry,
        ProductRepository $productRepository,
        $dataAttributes = [],
        array $data = []
    ) {
        parent::__construct($context, $buttonConfig, $generalConfig, $dataAttributes, $data);
        $this->coreRegistry = $coreRegistry;
        $this->productRepository = $productRepository;
    }

    public function getTitle(): string
    {
        return $this->buttonConfig->getTitle();
    }

    /**
     * @inheritDoc
     */
    public function getProduct()
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

    public function setProduct(ProductInterface $product)
    {
        $this->product = $this->productRepository->getById($product->getId());
    }
}
