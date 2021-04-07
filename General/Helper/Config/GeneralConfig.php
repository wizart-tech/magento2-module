<?php

declare(strict_types=1);

namespace Wizart\General\Helper\Config;

use Magento\Catalog\Model\Product;

class GeneralConfig extends AbstractConfig
{
    protected const GROUP = 'general';

    public function isModuleEnabled(): bool
    {
        return $this->isSetFlag('enabled') && $this->getConfigValue('token');
    }

    public function canProductVisualize(Product $product): bool
    {
        return filter_var($product->getData('wizart_visualize'), FILTER_VALIDATE_BOOLEAN);
    }

    public function getAPIToken(): ?string
    {
        return $this->getConfigValue('token') ?: null;
    }
}