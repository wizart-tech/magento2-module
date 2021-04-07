<?php

declare(strict_types=1);

namespace Wizart\EntryPointButton\Block;

use Magento\Catalog\Model\Product;
use Wizart\General\Block\AbstractButtonsTemplate;

abstract class AbstractEntryPointButtonBlock extends AbstractButtonsTemplate
{
    public function isEnabled(): bool
    {
        return parent::isEnabled()
            && $this->isProductExist()
            && $this->generalConfig->canProductVisualize($this->getProduct());
    }

    abstract public function getProduct(): ?Product;

    protected function isProductExist(): bool
    {
        $product = $this->getProduct();
        if (null === $product || !is_object($product)) {
            return false;
        }

        return true;
    }
}
