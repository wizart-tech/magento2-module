<?php

declare(strict_types=1);

namespace Wizart\General\Helper\Config;

use Magento\Catalog\Model\Product;
use Magento\Framework\App\Helper\Context;

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

    public function getContext(): ?string
    {
        return $this->getConfigValue('context') ?: null;
    }

    public function getParameters(): array
    {
        return [
            'main_page_link' => $this->_getUrl('/'),
            'context' => $this->getContext() ?? '',
        ];
    }

}