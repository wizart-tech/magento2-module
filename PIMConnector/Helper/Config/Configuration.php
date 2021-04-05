<?php

declare(strict_types=1);

namespace Wizart\PIMConnector\Helper\Config;

use Magento\Framework\App\Helper\AbstractHelper;

class Configuration extends AbstractHelper
{
    protected const API_ENDPOINT_URL = 'wizart_general/api/url';
    protected const API_AVAILABLE_SKU_URI = 'wizart_general/api/available_sku_uri';

    public function getEndpointUrl(): string
    {
        return $this->getConfigValue(static::API_ENDPOINT_URL);
    }

    public function getAvailableSkuUri(): string
    {
        return $this->getConfigValue(static::API_AVAILABLE_SKU_URI);
    }

    /**
     * @param $configPath
     * @return string|array|null
     */
    protected function getConfigValue(string $path)
    {
        return $this->scopeConfig->getValue($path);
    }

    protected function isSetFlag(string $path): bool
    {
        return $this->scopeConfig->isSetFlag($path);
    }
}